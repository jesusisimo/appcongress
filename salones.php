<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h3>Salones</h3> <? if(isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=salones&view" ></i>Ver todos</a><?}?>
    <form class="pull-right position user-head" action="" method="post">
      <input class="form-control search-btn2 "  type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar salón">
    </form>
  </section>
</div>

<div class="col-lg-12">
  <section class="panel">
    <header class="panel-heading">
        Salones             
    </header>
    <div class="panel-body ">
      <?
        $query="SELECT * FROM salones WHERE activo=1 ";
        if(isset($_POST['search']) && $_POST['search']!=""){
          $query.=" and salon like '%".$_POST['search']."%'";
        }
        $salones=$bd->ExecuteE($query);
        foreach ($salones as &$salon){
      ?>
      
        <div class="col-lg-3 panel-body profile-nav">
          <ul class="nav nav-pills nav-stacked">
            <li class="active">
            <a href="./?action=actividades&lugar=<?=$salon['id']?>">
             <?=$salon['salon']?>
            </a>
            <a href="./?action=actividades&lugar=<?=$salon['id']?>">
             <span class="btn btn-sm btn-primary">Ver actividades</span>
            </a>
            </li>
          </ul>
        </div>
      
      <?}?>
     
    </div>
  </section>
</div>






