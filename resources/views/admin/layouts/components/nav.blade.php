<link rel="stylesheet" href="{{ asset('admin/css/components/nav.css') }}" />
<div id="navigation">
    <nav class="blue-grey darken-3">
        <div class="x-navWrapper">
            <h1 class="brand-logo-wrapper">
                <a href="{{ url('admin') }}" class="brand-logo">Tôi thiết kế</a>
            </h1>
            <ul class="right hide-on-med-and-down">
                <li>
                    <a href="#!" id="searchLayout"
                        ><i class="material-icons">search</i></a
                    >
                </li>
                <li>
                    <a href="#!" id="toggleLayout"
                        ><i class="material-icons">view_module</i></a
                    >
                </li>
                <li>
                    <a href="#!" id="reloadLayout"
                        ><i class="material-icons">refresh</i></a
                    >
                </li>
            </ul>
        </div>
    </nav>
    @include('admin.layouts.components.breadcrumb')
    <div class="y-navWrapper">
        <input type="checkbox" id="toggleButton" />
        <nav class="grey darken-4">
            <div class="ul-wrapper">
                @if(isset($userLogin))
                <div class="user-board">
                    <ul id="profileMenu">
                        <div class="user-view">
                            <div class="background">
                                <img
                                    src="{{
                                            url('upload/user/'.$userLogin->cover)
                                        }}"
                                />
                                <span
                                    class="avatar"
                                    style="background: url('{{url('upload/user/'.$userLogin->avatar)}}') center / contain no-repeat"
                                >
                                    <a
                                        class="edit"
                                        href="{{url('/admin/user/edit').'/'.$userLogin->id}}"
                                    >
                                        <i class="material-icons">create</i>
                                    </a>
                                </span>
                                <div class="info">
                                    <p class="white-text text">
                                        {{$userLogin->name}}
                                        <small class="white-text">
                                            {{$userLogin->email}}
                                        </small>
                                    </p>
                                </div>
                                <a
                                    href="{{ url('/admin/logout') }}"
                                    class="logout material-icons"
                                    >exit_to_app</a
                                >
                            </div>
                        </div>
                    </ul>
                </div>
                <ul>
                    <li>
                        <a class="menu-item-title" href="{{ url('admin') }}"
                            >Home</a
                        >
                    </li>
                    <li>
                        <span class="menu-item-title">User</span>
                        <ul>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/user') }}"
                                    >📚 Danh sách</a
                                >
                            </li>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/user/add') }}"
                                    >＋ Thêm</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="menu-item-title">Thể loại</span>
                        <ul>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/theloai') }}"
                                    >📚 Danh sách</a
                                >
                            </li>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/theloai/add') }}"
                                    >＋ Thêm</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="menu-item-title">Loại tin</span>
                        <ul>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/loaitin') }}"
                                    >📚 Danh sách</a
                                >
                            </li>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/loaitin/add') }}"
                                    >＋ Thêm</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="menu-item-title">Tin tức</span>
                        <ul>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/tintuc') }}"
                                    >📚 Danh sách</a
                                >
                            </li>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/tintuc/add') }}"
                                    >＋ Thêm</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="menu-item-title">Slide</span>
                        <ul>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/slide') }}"
                                    >📚 Danh sách</a
                                >
                            </li>
                            <li>
                                <a
                                    class="menu-item-title"
                                    href="{{ url('admin/slide/add') }}"
                                    >＋ Thêm</a
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
                @else
                <div class="signin-view">
                    <a class="waves-effect waves-light red darken-4 btn-small"
                        ><i class="material-icons left">verified_user</i>Đăng
                        nhập</a
                    >
                </div>
                @endif
            </div>
            <label class="btn-floating pulse" for="toggleButton">
                <span>💊</span>
                <span>💊</span>
                <span>💊</span>
                <span>💊</span>
                <span>💊</span>
                <em>🦠</em>
            </label>
        </nav>
    </div>
</div>

<script type="text/javascript">
    // toggle y nav menu
    $(document).mouseup(function (e) {
        var toggleButton = $("label[for='toggleButton']");

        // if the target of the click isn't the toggleButton nor a descendant of the toggleButton
        if (
            !toggleButton.is(e.target) &&
            !$(".user-view .avatar").is(e.target) &&
            toggleButton.has(e.target).length === 0
        ) {
            $("#toggleButton").prop("checked", false);
        }
    });

    // toggle layout
    $("#toggleLayout").click(() => {
        $("body > main").toggleClass("container");
    });
    // reload layout
    $("#reloadLayout").click(() => {
        window.location.reload();
    });
</script>
