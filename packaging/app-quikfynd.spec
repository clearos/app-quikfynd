%global __os_install_post %{nil}
%define _binaries_in_noarch_packages_terminate_build 0
%define  debug_package %{nil}

Name: app-quikfynd
Epoch: 1
Version: 2.0.1
Release: 1%{dist}
Summary: **quikfynd_app_name**
License: Proprietary
Group: ClearOS/Apps
Packager: QuikFynd
Vendor: QuikFynd
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base
BuildRequires:  systemd
Requires(post): systemd
Requires(preun): systemd
Requires(postun): systemd
AutoReqProv: 0

%description
**quikfynd_app_description**

%package core
Summary: **quikfynd_app_name** - Core
License: Proprietary
Group: ClearOS/Apps
Requires: app-base-core
AutoReqProv: 0

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
install -D -m 0644 packaging/quikfynd.service %{buildroot}/lib/systemd/system/quikfynd.service

%post
logger -p local6.notice -t installer 'app-quikfynd - installing'

%post core
/sbin/chkconfig --add quikfynd >/dev/null 2>&1 || :
/usr/bin/systemctl enable quikfynd.service -q
/usr/bin/systemctl reload-or-restart quikfynd.service -q

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
/usr/bin/systemctl stop quikfynd.service -q
/usr/bin/systemctl disable quikfynd.service -q

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
/lib/systemd/system/quikfynd.service