<div class="container-fluid"><!-- this container fluid is cloesd at footer -->
  <div class="row"> <!-- this row is cloesd at footer -->
    <div class="col-sm-2" style="padding: 0px">
<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid" style="height: 655px;font-size: 16px">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active">
          <?= anchor("admin",'Dashboard<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-dashboard"></span>') ?>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Student <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li>
              <?= anchor("student/add_student",'Add Student') ?>   
            </li>
            <li class="divider"></li>
            <li>
               <?= anchor("student/studentListDisplay",'Student List') ?>
            </li>
          </ul>
        </li> 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Department <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li>
              <?= anchor("department/add_department",'Add Department') ?>      
             </li>
            <li class="divider"></li>
            <li>
              <?= anchor("department/department_list",'Department List') ?>
            </li>
          </ul>
        </li> 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Author <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
             <li>
              <?= anchor("author/addEdit_author",'Add/Edit Author') ?>
            </li>
            <li class="divider"></li>
            <li><a href="#">Author List</a></li>
          </ul>
        </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Book <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="#">Add Book</a></li>
            <li class="divider"></li>
            <li><a href="#">Book List</a></li>
          </ul>
        </li>   
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Issue Books <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="#">Issue Book</a></li>
            <li class="divider"></li>
            <li><a href="#">Issued Book List</a></li>
          </ul>
        </li>          
      </ul>
    </div>
  </div>
</nav>
</div>
