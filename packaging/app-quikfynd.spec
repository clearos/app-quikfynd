
Name: app-quikfynd
Epoch: 1
Version: 1.0.0
Release: 1%{dist}
Summary: **quikfynd_app_name**
License: GPLv3
Group: ClearOS/Apps
Packager: QuikFynd
Vendor: QuikFynd
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base

%description
**quikfynd_app_description**

%package core
Summary: **quikfynd_app_name** - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core

%description core
**quikfynd_app_description**

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/quikfynd
cp -r * %{buildroot}/usr/clearos/apps/quikfynd/

install -D -m 0644 packaging/quikfynd.conf %{buildroot}/etc/clearos/quikfynd.conf
install -D -m 0644 packaging/quikfynd.php %{buildroot}/var/clearos/base/daemon/quikfynd.php

%post
logger -p local6.notice -t installer 'app-quikfynd - installing'

%post core
logger -p local6.notice -t installer 'app-quikfynd-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/quikfynd/deploy/install ] && /usr/clearos/apps/quikfynd/deploy/install
fi

[ -x /usr/clearos/apps/quikfynd/deploy/upgrade ] && /usr/clearos/apps/quikfynd/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-quikfynd - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-quikfynd-core - uninstalling'
    [ -x /usr/clearos/apps/quikfynd/deploy/uninstall ] && /usr/clearos/apps/quikfynd/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/quikfynd/controllers
/usr/clearos/apps/quikfynd/htdocs
/usr/clearos/apps/quikfynd/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/quikfynd/packaging
%dir /usr/clearos/apps/quikfynd
/usr/clearos/apps/quikfynd/deploy
/usr/clearos/apps/quikfynd/language
/usr/clearos/apps/quikfynd/libraries
%attr(0644,webconfig,webconfig) %config(noreplace) /etc/clearos/quikfynd.conf
/var/clearos/base/daemon/quikfynd.php
