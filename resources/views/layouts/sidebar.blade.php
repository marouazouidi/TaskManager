<style>
    .tf-sidebar {
        position: fixed;
        top: 56px;
        left: 0;
        width: 190px;
        height: calc(100vh - 56px);
        background: linear-gradient(180deg, #e8a0c8 0%, #c9a0d8 40%, #b098e0 70%, #a890e0 100%);
        padding: 28px 16px 24px;
        display: flex;
        flex-direction: column;
        z-index: 40;
        font-family: 'Outfit', sans-serif;
        overflow-y: auto;
    }

    /* ── Brand / Logo ── */
    .tf-sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 8px;
        margin-bottom: 36px;
    }

    .tf-sidebar-brand-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .tf-sidebar-brand-icon svg {
        width: 20px;
        height: 20px;
        color: rgba(255, 255, 255, 0.85);
    }

    .tf-sidebar-brand-text h2 {
        font-size: 0.95rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.95);
        letter-spacing: 1px;
        text-transform: uppercase;
        line-height: 1.2;
    }

    .tf-sidebar-brand-text span {
        font-size: 0.6rem;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.6);
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    /* ── Navigation Links ── */
    .tf-sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .tf-sidebar-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.7);
        transition: all 0.25s ease;
    }

    .tf-sidebar-link:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.2);
    }

    .tf-sidebar-link.active {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.35);
        box-shadow: 0 2px 12px rgba(255, 255, 255, 0.15);
    }

    .tf-sidebar-link svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    /* ── Logout ── */
    .tf-sidebar-bottom {
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    .tf-sidebar-logout {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.7);
        transition: all 0.25s ease;
        cursor: pointer;
        background: none;
        border: none;
        width: 100%;
        font-family: 'Outfit', sans-serif;
    }

    .tf-sidebar-logout:hover {
        color: rgba(180, 50, 50, 0.8);
        background: rgba(255, 255, 255, 0.2);
    }

    .tf-sidebar-logout svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }
</style>

<aside class="tf-sidebar">

    {{-- Brand --}}
    <div class="tf-sidebar-brand">
        <div class="tf-sidebar-brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="tf-sidebar-brand-text">
            <h2>Tasks<br>App</h2>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="tf-sidebar-nav">

        <a href="{{ route('tasks.index') }}" class="tf-sidebar-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Tasks
        </a>

        <a href="{{ route('tasks.create') }}" class="tf-sidebar-link {{ request()->routeIs('tasks.create') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Add Task
        </a>

    </nav>

    {{-- Logout --}}
    <div class="tf-sidebar-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="tf-sidebar-logout" onclick="event.preventDefault(); this.closest('form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
                Log Out
            </a>
        </form>
    </div>

</aside>