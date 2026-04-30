<style>
    .taskflow-nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 50;
        background: linear-gradient(135deg, #e8a0c8 0%, #c9a0d8 40%, #b098e0 70%, #a890e0 100%);
        padding: 0 32px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 16px rgba(150, 100, 180, 0.18);
    }

    .taskflow-nav-logo {
        font-family: 'Outfit', sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        letter-spacing: 0.3px;
        transition: color 0.2s ease;
    }

    .taskflow-nav-logo:hover {
        color: #ffffff;
    }

    .taskflow-nav-center {
        display: flex;
        align-items: center;
        gap: 36px;
    }

    .taskflow-nav-link {
        font-family: 'Outfit', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.65);
        text-decoration: none;
        padding: 6px 0;
        position: relative;
        transition: color 0.25s ease;
    }

    .taskflow-nav-link:hover {
        color: rgba(255, 255, 255, 0.95);
    }

    .taskflow-nav-link.active {
        color: #ffffff;
    }

    .taskflow-nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: #ffffff;
        border-radius: 2px;
    }

    .taskflow-nav-right {
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
    }

    .taskflow-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #d4a0c8, #9a80c8);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        border: 2px solid rgba(255, 255, 255, 0.35);
    }

    .taskflow-avatar svg {
        width: 18px;
        height: 18px;
        color: rgba(255, 255, 255, 0.9);
    }

    .taskflow-user-trigger {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 8px;
        transition: background 0.2s ease;
    }

    .taskflow-user-trigger:hover {
        background: rgba(255, 255, 255, 0.12);
    }

    .taskflow-user-name {
        font-family: 'Outfit', sans-serif;
        font-size: 0.88rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9);
    }

    .taskflow-chevron svg {
        width: 14px;
        height: 14px;
        color: rgba(255, 255, 255, 0.6);
        transition: transform 0.2s ease;
    }

    @media (max-width: 640px) {
        .taskflow-nav-center {
            display: none;
        }

        .taskflow-nav {
            padding: 0 20px;
        }
    }
</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<nav class="taskflow-nav">
    {{-- Left: Logo --}}
    <a href="{{ route('tasks.index') }}" class="taskflow-nav-logo">Task Manager</a>

    {{-- Center: Navigation Links --}}
    <div class="taskflow-nav-center">
        <a href="{{ route('tasks.index') }}"
            class="taskflow-nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}">Dashboard</a>
    </div>

    {{-- Right: User Dropdown --}}
    <div class="taskflow-nav-right hidden sm:flex sm:items-center">
        {{-- <x-dropdown align="right" width="48"> --}}

            <div>
                <button class="taskflow-user-trigger">
                    <div class="taskflow-avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <a class="taskflow-user-name" href="{{ route('profile.edit') }}">{{ Auth::user()->name }} </a>
                    {{-- <span class="taskflow-user-name">{{ Auth::user()->name }}</span> --}}
                    {{-- <div class="taskflow-chevron">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div> --}}
                </button>
            </div>



            {{--
        </x-dropdown> --}}
    </div>

</nav>