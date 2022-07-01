

    @if (auth('web')->check())
            @include('admin.layouts.side-bar.admin-side-bar')
    @endif
    @if (auth('student')->check())
        @include('admin.layouts.side-bar.student-side-bar')
    @endif

    @if (auth('teacher')->check())
        @include('admin.layouts.side-bar.teacher-side-bar')
    @endif
    @if (auth('parent')->check())
        @include('admin.layouts.side-bar.parent-side-bar')
    @endif
