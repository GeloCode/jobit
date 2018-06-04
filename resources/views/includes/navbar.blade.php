<nav class="navbar navbar-expand-lg navbar-light bg-light primary ">
  <div class="container">
  <div class="navbar-brand">
    <a href="{{ url('/home') }}">
      <svg version="1.1" id="OTM-Logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="50px" height="50px" viewBox="-25 -25 -50 -30" enable-background="new -25 -25 0 0" xml:space="preserve">
        <!-- Filters -->
        <defs>
          <filter id="glow">
            <feGaussianBlur stdDeviation="4" result="coloredBlur"></feGaussianBlur>
            <feMerge>
              <feMergeNode in="coloredBlur"></feMergeNode>
              <feMergeNode in="SourceGraphic"></feMergeNode>
            </feMerge>
          </filter>
        </defs>
        <g class="fade">
          <g class="logo-march">
            <g class="random3">
              <path d="M17.567,15.938l-2.859-2.702c0.333-0.605,0.539-1.29,0.539-2.029c0-2.342-1.897-4.239-4.24-4.239
				c-2.343,0-4.243,1.896-4.243,4.239c0,2.343,1.9,4.241,4.243,4.241c0.826,0,1.59-0.246,2.242-0.654l2.855,2.699
				C16.536,16.922,17.023,16.399,17.567,15.938z"></path>
              <path d="M29.66,15.6l3.799-6.393c0.374,0.107,0.762,0.184,1.169,0.184c2.347,0,4.244-1.898,4.244-4.241
				c0-2.342-1.897-4.239-4.244-4.239c-2.343,0-4.239,1.896-4.239,4.239c0,1.163,0.469,2.214,1.227,2.981l-3.787,6.375
				C28.48,14.801,29.094,15.169,29.66,15.6z"></path>
              <path d="M42.762,20.952c-1.824,0-3.369,1.159-3.968,2.775l-5.278-0.521c0,0.04,0.006,0.078,0.006,0.117
				c0,0.688-0.076,1.36-0.213,2.009l5.276,0.521c0.319,2.024,2.062,3.576,4.177,3.576c2.342,0,4.238-1.896,4.238-4.238
				C47,22.85,45.104,20.952,42.762,20.952z"></path>
              <path d="M28.197,37.624l-1.18-5.156c-0.666,0.232-1.359,0.398-2.082,0.481l1.182,5.157c-1.355,0.709-2.29,2.11-2.29,3.746
				c0,2.342,1.896,4.237,4.243,4.237c2.342,0,4.238-1.896,4.238-4.237C32.311,39.553,30.479,37.692,28.197,37.624z"></path>
              <path d="M14.357,25.37l-6.57,2.201c-0.758-1.158-2.063-1.926-3.548-1.926C1.896,25.645,0,27.542,0,29.884
				c0,2.345,1.896,4.242,4.239,4.242c2.341,0,4.242-1.897,4.242-4.242c0-0.098-0.021-0.188-0.029-0.284l6.591-2.207
				C14.746,26.752,14.51,26.077,14.357,25.37z"></path>
              <circle cx="23.83" cy="23.323" r="7.271" stroke="#28a745" fill="#28a745"></circle>
            </g>
          </g>
        </g>
        <!-- End Logo Container -->
      </svg>

      <div>Job IT</div>
    </a>
  </div>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/home">Home</a>
      </li>

      @if (!Auth::check() || !Auth::user()->isEmpresa())
      <li class="nav-item">
        <a class="nav-link" href="/vofertas">Ofertas</a>
      </li>
      @endif
      @if (Auth::check())
        @if (!Auth::user()->isEmpresa())
        
        <li class="nav-item">
          <a class="nav-link" href="/vinscripcionesolicitante">Tus inscripciones</a>
        </li>
        @endif
        @if (Auth::user()->isEmpresa())
        <li class="nav-item">
          <a class="nav-link" href="/vofertasempresa">Tus Ofertas (Ofertas Empresa)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/vinscripcionesempresa">Solicitantes</a>
        </li>  
        @endif
      @endif
      <li class="nav-item">
        <a class="nav-link" href="/portf">Portfolios usuarios</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
      <li>
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
      <li>
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
      </li>
      @else
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false" v-pre>
          {{App\Perfil::where('user_id', Auth::id())->value('name')}}
          <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a class="dropdown-item" href="/perfil">Perfil</a>
          @if (!Auth::user()->isEmpresa() && App\Portfolio::where('user_id', Auth::id())->value('id'))
          <a class="dropdown-item" href="/projects?id={{App\Portfolio::where('user_id', Auth::id())->value('id')}}">Portfolio</a>
          @elseif (!Auth::user()->isEmpresa() && !App\Portfolio::where('user_id', Auth::id())->value('id'))
              <a class="dropdown-item" href="/formulario">Portfolio</a>
            @endif
          </li>  
        </div>
      </li>
      @endguest
    </ul>
  </div>
  </div>
</nav>