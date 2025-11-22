<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->fullname }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @php
          use Illuminate\Support\Facades\DB;
          $db_menu_parent = DB::table('menu')->select('id','nama_menu','font_icon')->where('menu_parent_id','=',0)->orderBy('sort','asc')->get();
          $count = $db_menu_parent->count();
          $arr_menu_parent_id = array();
          $arr_menu_parent_name = array();
          $arr_font_icon = array();
          foreach($db_menu_parent as $row){
            array_push($arr_menu_parent_id,$row->id);
            array_push($arr_menu_parent_name,$row->nama_menu);
            array_push($arr_font_icon,$row->font_icon);
          }
          function menu_apps($index,$arr_menu_parent_id,$arr_menu_parent_name,$arr_font_icon,$count,$active_gm,$active_m){
              
            if($index < $count){
              $db_menu = DB::table('menu')->join('usersprivilege','usersprivilege.menu_id','=','menu.id')->select('nama_menu','path','font_icon')->where('usersprivilege.user_id',auth()->user()->id)->where('menu_parent_id','=',$arr_menu_parent_id[$index])->get();
              if($db_menu->count() > 0){

                echo "<li class='nav-item ".($active_gm == $arr_menu_parent_name[$index] ? 'menu-open' : 'menu-close')."'><a href='#' class='nav-link ".($active_gm== $arr_menu_parent_name[$index] ? 'active' : '')."'><i class='nav-icon ".$arr_font_icon[$index]."'></i><p>".$arr_menu_parent_name[$index]."<i class='right fas fa-caret-right'></i></p></a>";
                $arr_nama_menu = array();
                foreach($db_menu as $row){
                  array_push($arr_nama_menu,$row->nama_menu);
                  echo "<ul class='nav nav-treeview'>
                  <li class='nav-item'>
                    <a class='nav-link ".($active_m == $row->path ? 'active' : '')."' href='/".$row->path."'>
                      <i class='".$row->font_icon."'></i>&nbsp;
                      <p>".$row->nama_menu."</p>
                    </a>
                  </li>
              </ul>";
                }
                echo "</li>";
              }
              menu_apps($index+1,$arr_menu_parent_id,$arr_menu_parent_name,$arr_font_icon,$count,$active_gm,$active_m);
            }
          }

          menu_apps($index=0,$arr_menu_parent_id,$arr_menu_parent_name,$arr_font_icon,$count,$active_gm,$active_m);
        @endphp
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>