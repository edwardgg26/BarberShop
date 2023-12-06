<nav class="w-100">
    <ul class="user-select-none pagination pagination-md w-100 text-center container-fluid">
        <li class="page-item w-100" >
            <a href="/admin" class="page-link w-100 <?php if(strpos($_SERVER['PATH_INFO'],'/admin') !== false) echo 'active'?>" tabindex="1" aria-disabled="true">Citas</a> 
        </li>
        <li class="page-item w-100">
            <a href="/servicios" class="page-link w-100 <?php if(strpos($_SERVER['PATH_INFO'],'/servicios') !== false) echo 'active'?>" aria-disabled="true" tabindex="2">Servicios</a> 
        </li>
        <li class="page-item w-100">
            <a href="/barberos" class="page-link w-100 <?php if(strpos($_SERVER['PATH_INFO'],'/barberos') !== false) echo 'active'?>" aria-disabled="true" tabindex="3">Barberos</a> 
        </li>
    </ul>
</nav>