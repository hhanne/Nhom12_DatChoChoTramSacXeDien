<!-- resources/views/profile/includes/sidebar.blade.php -->
<aside class="col-lg-3">
    <div class="profile-sidebar">
        <div class="profile-user">
            <div class="avatar">{{ substr(Auth::user()->hoten ?? Auth::user()->name, 0, 1) }}</div>
            <div>
                <p class="name">{{ Auth::user()->hoten ?? Auth::user()->name }}</p>
                <p class="email">{{ Auth::user()->email }}</p>
            </div>
        </div>

<ul class="nav flex-column profile-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('profile.show') ? 'active' : '' }}" href="{{ route('profile.show') }}">
            <i class="fas fa-user-edit"></i> Hồ sơ cá nhân
        </a>
    </li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('profile.password') ? 'active' : '' }}" href="{{ route('profile.password') }}">
        <i class="fas fa-lock"></i> Đổi mật khẩu
    </a>
</li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('profile.history') ? 'active' : '' }}" href="{{ route('profile.history') }}">
            <i class="fas fa-history"></i> Lịch sử đặt chỗ
        </a>
    </li>
</ul>

        </ul>
    </div>
</aside>
