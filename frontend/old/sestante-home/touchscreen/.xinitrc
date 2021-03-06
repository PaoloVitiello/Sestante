#!/bin/sh

# fix broken $UID on some system...
if test "x$UID" = "x"; then
	UID=`id -u`
fi

# create temp file for X resources
if [ -x /usr/bin/tempfile ]; then
  XRESOURCES="$(/usr/bin/tempfile -p xrdb-)"
elif [ -x /usr/bin/mcookie ]; then
  XRESOURCES="/tmp/xrdb-$(/usr/bin/mcookie)"
else
  XRESOURCES="/tmp/xrdb-$UID.$$"
fi

# Has to go prior to merging Xft.xrdb, as its the "Defaults" file
test -r $HOME/.Xdefaults && cat $HOME/.Xdefaults >> $XRESOURCES

# Check if the user wants to override the above defaults (set by
# mcs ui plugin)
if test "x$XDG_CONFIG_HOME" = "x" ; then
  BASEDIR=$HOME/.config/xfce4
else
  BASEDIR=$XDG_CONFIG_HOME/xfce4
fi

if test -r $BASEDIR/Xft.xrdb; then
  cat $BASEDIR/Xft.xrdb >> $XRESOURCES
elif test -r $XFCE4HOME/Xft.xrdb; then
  mkdir -p $BASEDIR
  cp $XFCE4HOME/Xft.xrdb $BASEDIR/
  cat $BASEDIR/Xft.xrdb >> $XRESOURCES
else
  # Those are fallback settings, use the ui plugin to change it
  # or add your overrides to ~/.Xresources
  # Xft DPI: 96
  # Xft.hintstyle: hintnone/hintslight/hintmedium/hintfull
  # Xft hinting: 1/0
  cat >> $XRESOURCES << EOF
Xft.dpi: 96
Xft.hinting: 1
Xft.hintstyle: hintmedium
EOF
fi

# ~/.Xresources contains overrides to the above
test -r $HOME/.Xresources && cat $HOME/.Xresources >> $XRESOURCES

# load all X resources
xrdb -nocpp -merge $XRESOURCES
rm -f $XRESOURCES

# load local modmap
test -r $HOME/.Xmodmap && xmodmap $HOME/.Xmodmap

# Launch xscreensaver (if available), but only as non-root user
test $UID -gt 0 -a -z "$VNCSESSION" && xscreensaver -no-splash &

# Use ssh-agent if installed and not already running.  Run it separately
# so it populates the environment here, so we can clean it up later.
sshagent=`which ssh-agent`
kill_sshagent=0
if test -z "$SSH_AGENT_PID" -a "$sshagent" -a "x$sshagent" != "xno"; then
	eval `$sshagent -s`
	kill_sshagent=1
fi

# Use dbus-launch if installed.
if test x"$DBUS_SESSION_BUS_ADDRESS" = x""; then
	dbuslaunch=`which dbus-launch`
	if test x"$dbuslaunch" != x"" -a x"$dbuslaunch" != x"no"; then
		eval `$dbuslaunch --sh-syntax --exit-with-session`
	fi
fi

# Run xfce4-session if installed
xfcesm=`which xfce4-session`
case "x$xfcesm" in
	x|xno*)
		;;
	*)
		$xfcesm

		if test $kill_sshagent -eq 1; then
			eval `$sshagent -k`
		fi
		exit 0
		;;
esac


##################
# IMPORTANT NOTE #
##################

# Everything below here ONLY gets executed if you are NOT using xfce4-session
# (Xfce's session manager).  If you are using the session manager, everything
# below is handled by it, and the code below is not executed at all.  If you're
# not sure if you're using the session manager, type 'ps -e|grep xfce4-session'
# in a terminal while Xfce is running.

##################


# this is only necessary when running w/o xfce4-session
xsetroot -solid black -cursor_name watch

# or use old-fashioned startup script otherwise

xfce-mcs-manager
xfwm4 --daemon

# Start-up stuff from ~/Desktop/Autostart directory, if it exists
# (as it seems to be the new standard)
if test -d "$HOME/Desktop/Autostart"; then
  for i in `ls -1 -L ${HOME}/Desktop/Autostart/ 2>/dev/null`; do
    if test -x $HOME/Desktop/Autostart/$i; then
      $HOME/Desktop/Autostart/$i &
    fi
  done
fi

xftaskbar4&
xfdesktop&
xfcalendar &

panel=`which xfce4-panel`
case "x$panel" in
	x|xno*)
		;;
	*)
		$panel
		ret=$?
		while test $ret -ne 0; do
			xmessage -center -file - -timeout 20 -title Error <<EOF
A crash occured in the panel
Please report this to the xfce4-dev@xfce.org list
or on http://bugs.xfce.org
Meanwhile the panel will be restarted
EOF
			cat >&2 <<EOF
A crash occured in the panel
Please report this to the xfce4-dev@xfce.org list
or on http://bugs.xfce.org
Meanwhile the panel will be restarted
EOF
			$panel
			ret=$?
		done
		;;
esac

if test $kill_sshagent -eq 1; then
	eval `$sshagent -k`
fi

xsetroot -bg white -fg red  -solid black -cursor_name watch
