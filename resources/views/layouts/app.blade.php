<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FiercePhish{{ (isset($title))?' &raquo; '.$title:'' }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">

    <!-- Other libraries -->
    <link href="{{ asset('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables.net-select-bs/css/select.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/jt.timepicker/jquery.timepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/tooltipster/dist/css/tooltipster.bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/tooltipster/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css') }}" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{ asset('vendor/gentelella/build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fiercephish.css') }}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-envelope-o"></i> <span><span style="color: #FF4800">Fierce</span>Phish</span></a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ action('DashboardController@index') }}">Dashboard</a></li>
                      <!--<li><a href="#">Statistics</a></li>-->

                    </ul>
                  </li>
                  <li><a><i class="fa fa-bullseye"></i> Targets <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ action('TargetsController@index') }}">All Targets</a></li>
                      <li><a href="{{ action('TargetsController@targetlists_index') }}">All Lists</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-play"></i> Campaigns <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ action('CampaignController@index') }}">View all campaigns</a></li>
                      <li><a href="{{ action('CampaignController@create') }}">Create new campaign</a></li>
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-envelope-o"></i> Emails <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ action('EmailController@send_simple_index') }}">Simple Send</a></li>
                      <li><a href="{{ action('EmailController@template_index') }}">Email Templates</a></li>
                      <!--<li><a href="#">Inbox</a></li>-->
                      <li><a href="{{ action('EmailController@check_settings_index') }}">Check Email DNS</a></li>
                      <li><a href="{{ action('EmailController@email_log') }}">Email Log</a></li>
                    </ul>
                  </li><!--
                  <li><a><i class="fa fa-sitemap"></i>Sites <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">View all sites</a></li>
                      <li><a href="#">Site cloner</a></li>
                      <li><a href="#">Site customizer</a></li>
                    </ul>
                  </li>-->
                  <li><a><i class="fa fa-gear"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ action('SettingsController@index') }}">User Management</a></li>
                      <li><a href="{{ action('SettingsController@get_config') }}">Configuration</a></li>
                      <li><a href="{{ action('SettingsController@get_import_export') }}">Import / Export</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3><i class="fa fa-bullhorn"></i> Active Campaigns ({{ $layout_all_active_campaigns->count() }})</h3>
                <ul class="nav side-menu">
                  @foreach ($layout_all_active_campaigns as $camp)
                    <li><a>{{ $camp->name }} <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{ action('CampaignController@campaign_details', ['id' => $camp->id ]) }}">View Campaign</a></li>
                        <li><a>{{ (100-round((($camp->emails()->where('status', \App\Email::NOT_SENT)->count())/($camp->emails()->count())*100))) }}% Complete</a></li>
                      </ul>
                    </li>
                  @endforeach
                  @if ($layout_all_active_campaigns->count() == 0)
                    <li><a>No active campaigns!</a></li>
                  @endif
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle" style="color: #171819"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ title_case(auth()->user()->name) }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ action('SettingsController@get_editprofile') }}"> Profile</a></li>
                    <li><a href="https://github.com/Raikia/FiercePhish/wiki" target="_blank">Help</a></li>
                    <li><a href="{{ action('Auth\AuthController@logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!--<li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-red">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>-->
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-tasks"></i>
                    <span id="hasBadge">
                    @if (\App\ProcessingJob::count() != 0)
                      <span class="badge bg-red">{{ \App\ProcessingJob::count() }}</span>
                    @endif
                    </span>
                  </a>
                  <ul id="jobMenu" class="dropdown-menu list-unstyled msg_list" style="max-height: 400px; overflow-y: auto;" role="menu">
                    @foreach (\App\ProcessingJob::all() as $j)
                      <li>
                        <a>
                          <span class="image"><i class="fa fa-{{ $j->icon }}"></i></span>
                          <span>
                            <span style="margin-left: 5px;">{{ $j->name }}</span>
                            <span class="time">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($j->created_at))->diffForHumans() }}</span>
                          </span>
                          <span class="message">
                            @if ($j->description != '')
                              <div style="margin-left: 23px;">{{ $j->description }}</div>
                            @endif
                           <div class="progress" style="margin-top: 7px;">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $j->progress }}" aria-valuemin="0" aria-valuemax="100" style="background-color: #FF4800; min-width: 2em; width: {{ $j->progress }}%;">
                              {{ $j->progress }}%
                            </div>
                          </div>
                          </span>
                        </a>
                      </li>
                    @endforeach
                    @if (\App\ProcessingJob::count() == 0)
                      <li>No running jobs</li>
                    @endif
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            @include('common.notifications')
            @yield('content')
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <a href="https://github.com/Raikia/FiercePhish">FiercePhish</a> v{{ config('app.version') }}. Made by <a href="https://github.com/Raikia/">Chris King</a> (<a href="https://twitter.com/raikiasec">@raikiasec</a>). See <a href="https://github.com/Raikia/FiercePhish/issues">GitHub Issues</a> for bug reports or feature requests!. &nbsp;&nbsp;&nbsp;&nbsp;Page rendered in {{ number_format(microtime(true) - LARAVEL_START, 3) }} seconds
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <div id="loading_modal" class="modal fade loading-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm" style="margin-top: 300px;">
        <div class="modal-content" style="width: 61px; margin-left: auto; margin-right: auto;">
          <div class="modal-body">
            <img src="{{ asset('images/ajax-loader.gif') }}" alt="Loading..." />
          </div>
        </div>
      </div>
    </div>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{ asset('vendor/Flot/excanvas.min.js') }}"></script><![endif]-->
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('vendor/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendor/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/blockUI/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/jt.timepicker/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootbox.js/bootbox.js') }}"></script>
    <script src="{{ asset('vendor/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendor/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('vendor/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('vendor/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('vendor/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('vendor/tooltipster/dist/js/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/tooltipster/dist/js/plugins/tooltipster/SVG/tooltipster-SVG.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('vendor/DateJS/build/production/date.min.js') }}"></script>
    <script src="{{ asset('vendor/gentelella/build/js/custom.min.js') }}"></script>
    @yield('footer')
    <script type="text/javascript">
    /* global $ */
      $(document).ready(function() {
        $(".alert").slideDown(1000).delay(10000).slideUp(1000);
        $(":input").inputmask();
        window.setInterval(grabJobs, 2000);
        $(".tt").tooltipster({
          //theme: 'tooltipster-light',
        });
      });
      
      function grabJobs()
      {
        $.get("{{ action('AjaxController@get_jobs') }}", function(results) {
          $("#jobMenu").html(results['html']);
          if (results['num'] == 0)
          {
            $("#hasBadge").html('');
          }
          else
          {
            $("#hasBadge").html('<span class="badge bg-red">' + results['num'] + '</span>');
          }
        });
      }
    </script>
  </body>
</html>
