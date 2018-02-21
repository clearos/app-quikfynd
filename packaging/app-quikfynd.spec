
Name: app-quikfynd
Epoch: 1
Version: 3.0.4
Release: 1%{dist}
Summary: QuikFynd
License: Proprietary
Group: ClearOS/Apps
Packager: QuikFynd
Vendor: QuikFynd
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base
Requires: app-network

%description
QuikFynd intelligently organizes data on your server and connected accounts, so that you can find your files quickly using its full text search capabilities.

%package core
Summary: QuikFynd - Core
License: Proprietary
Group: ClearOS/Libraries
Requires: app-base-core
Requires: quikfynd

%description core
QuikFynd intelligently organizes data on your server and connected accounts, so that you can find your files quickly using its full text search capabilities.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/quikfynd
cp -r * %{buildroot}/usr/clearos/apps/quikfynd/

install -d -m 0755 %{buildroot}/mnt/qfmounts
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
%exclude /usr/clearos/apps/quikfynd/unify.json
%dir /usr/clearos/apps/quikfynd
%dir /mnt/qfmounts
/usr/clearos/apps/quikfynd/deploy
/usr/clearos/apps/quikfynd/language
/usr/clearos/apps/quikfynd/libraries
%attr(0644,webconfig,webconfig) %config(noreplace) /etc/clearos/quikfynd.conf
/var/clearos/base/daemon/quikfynd.php
