<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h3>Comité organizador</h3> <? if(isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=comite_organizador&view" ></i>Ver todos</a><?}?>
    <form class="pull-right position user-head" action="" method="post">
      <input class="form-control search-btn2 "  type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar comite">
    </form>
  </section>
</div>

<div class="col-lg-12">
  <section class="panel">
    <header class="panel-heading">
        Comité             
    </header>
    <div class="panel-body ">
      <?
        $query="SELECT * FROM comite_organizador WHERE activo=1 ";
        if(isset($_POST['search']) && $_POST['search']!=""){
          $query.=" and (nombre like '%".$_POST['search']."%' or puesto like '%".$_POST['search']."%')";
        }
        $comites=$bd->ExecuteE($query);
        foreach ($comites as &$comite){
      ?>
      
        <div class="col-lg-3 panel-body profile-nav">
          <ul class="nav nav-pills nav-stacked">
            <li class="active">
            <a href="javascript:;">
             <h4 class="terques"><?=$comite['nombre']?></h4>
             <p><?=$comite['puesto']?> <i class="fa fa-tag"> </i></p>
            </a>
            </li>
          </ul>
        </div>
      
      <?}?>
     
    </div>
  </section>
</div>






