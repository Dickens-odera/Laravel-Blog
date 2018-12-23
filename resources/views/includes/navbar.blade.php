<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navigation-menu">

                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{url('/')}}" class="navbar-brand">{{config('app.name')}}</a>
        </div>
        <div class="collapse navbar-collapse navigation-menu">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/about')}}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/services')}}">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/team')}}">Team</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/posts')}}">Blog</a></li>
            </ul>
        </div>
    </div>
</nav>
