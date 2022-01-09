<!-- //Sticky Header -->
<header id="stickyHeader" class="header-area header-sticky d-none">
    <div class="header-sticky-inner  bg-sticky-bar">
      <div class="container">
  
        <div class="row align-items-center">
          
          <div class="col-12 col-lg-2">
            <div class="logo">
              <a href="index.html">
                <a href="{{url('/')}}" class="logo" data-toggle="tooltip" data-placement="bottom" title="{{isset(getSetting()['site_name']) ? getSetting()['site_name'] : 'Logo' }}">
                  <img class="img-fluid" src="{{isset(getSetting()['site_logo']) ? getSetting()['site_logo'] : asset('01-logo.png') }}" alt="{{isset(getSetting()['site_name']) ? getSetting()['site_name'] : 'Logo' }}">
                </a>
              </a>
            </div>
          </div>
          <div class="col-12 col-lg-7" style="position: static;">
            <nav id="navbar_header_9" class="navbar navbar-expand-lg  bg-nav-bar">
              <div class="navbar-collapse">
                <ul class="navbar-nav">
                  @php $temp = '0' @endphp
                  @if(isset($header_menu->menu))
                  @php $header_menu = json_decode(($header_menu->menu), true); $menuloop = 0; @endphp
                  @foreach($header_menu as $menu[$menuloop])
                  @if(count($menu[$menuloop]['children']) == 0)
      
      
                  @php $link = '#' @endphp
                  @if($menu[$menuloop]['type'] == 'exlink')
                      @php $link = $menu[$menuloop]['exlink'] @endphp
                  @elseif($menu[$menuloop]['type'] == 'product')
                      @php $link = url('/product').$menu[$menuloop]['product'] @endphp
                  @elseif($menu[$menuloop]['type'] == 'category')
                      @php $link = url('/shop').'?category='.$menu[$menuloop]['category'] @endphp
                  @elseif($menu[$menuloop]['type'] == 'link')
                      @php $link = url('/').$menu[$menuloop]['link'] @endphp
                  
                  @elseif($menu[$menuloop]['type'] == 'page')
                      @php $link = url('/').$menu[$menuloop]['page'] @endphp
                  @endif
                  
                  <li class="nav-item">
                    <a class="nav-link " href="{{$link}}">
                      <?php $index = 0; ?>
                      @if(isset($menu[$menuloop]['language_id']))
                      @php $index = array_search($data['selectedLenguage'],$menu[$menuloop]['language_id']) @endphp
                      @endif
                      {{$menu[$menuloop]['name'][$index]}}
                    </a>
                  </li>
                  @else
      
                  @php $link = '#' @endphp
                  @if($menu[$menuloop]['type'] == 'exlink')
                      @php $link = $menu[$menuloop]['exlink'] @endphp
                  @elseif($menu[$menuloop]['type'] == 'product')
                      @php $link = url('/product').$menu[$menuloop]['product'] @endphp
                  @elseif($menu[$menuloop]['type'] == 'category')
                      @php $link = url('/shop').'?category='.$menu[$menuloop]['category'] @endphp
                  @elseif($menu[$menuloop]['type'] == 'link')
                      @php $link = url('/').$menu[$menuloop]['link'] @endphp
                  @elseif($menu[$menuloop]['type'] == 'page')
                      @php $link = url('/').$menu[$menuloop]['page'] @endphp
                  @endif
                  
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{$link}}">
                      <?php $index = 0; ?>
                      @if(isset($menu[$menuloop]['language_id']))
                      @php $index = array_search($data['selectedLenguage'],$menu[$menuloop]['language_id']) @endphp
                      @endif
                      {{$menu[$menuloop]['name'][$index]}}
                    </a>
                    @if(count($menu[$menuloop]['children']) > 0)
                      @include('includes.headers.menu')
                    @endif
                  </li>
                  @endif
                  @endforeach
                  @endif
                </ul>
              </div>
            </nav>
          </div>
          <div class="col-6 col-sm-6 col-md-4 col-lg-3">
            <ul class="pro-header-right-options">
              <li>
                <a href="{{ url('/wishlist') }}" class="" data-toggle="tooltip" data-placement="bottom" title="{{ trans('lables.header-wishlist') }}">
                  <i class="far fa-heart"></i>
                </a>
              </li>
              <li>
                <a href="{{ url('/cart') }}" class="" data-toggle="tooltip" data-placement="bottom" title="{{ trans('lables.header-view-cart') }}">
                    <i class="fas fa-shopping-bag"></i>
                </a>
              </li>
            </ul>
  
  
          </div>
          
        </div>
      </div>
    </div>
  </header>