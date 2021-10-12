<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="">
      <div class="navbar-header">
        <a href="{{ route("/") }}" class="logo">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Animalerie ULB</b></span> 
        </a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <div>MENU</div>
        </button>   
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Registres <i class="fa fa-caret-down"></i>
                </a>
                <?php $agrements = App\Agrement::all() ?>
                <ul class="dropdown-menu">
                    @foreach($agrements as $agrement)
                        @foreach($agrement->species as $specie)
                            <li>
                                <a target="_blank" href="{{ $specie->pivot->url_file }}">
                                    <div>
                                        <strong>
                                            {{ $agrement->name }}
                                            {{ $specie->name }}
                                        </strong>
                                    </div>
                                </a>
                            </li> 
                        @endforeach
                    @endforeach 
                </ul>
            </li>              
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Agréments <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route("agrements.index") }}">
                            <div>
                                <strong>Liste</strong>
                            </div>
                        </a>
                    </li>                        
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route("species.index") }}">
                            <div>
                                <strong>Gérer les espèces</strong>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>                
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Protocoles <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route("protocols.index") }}">
                            <div>
                                <strong>Liste</strong>
                            </div>
                        </a>
                    </li>                        
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route("domains.index") }}">
                            <div>
                                <strong>Gérer les domaines</strong>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route("severities.index") }}">
                            <div>
                                <strong>Classes de sévérité</strong>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>                                  
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Fournitures <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route("supplies.index") }}">
                            <div>
                                <strong>Liste</strong>
                            </div>
                        </a>
                    </li>                        
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route("stock.registries.index") }}">
                            <div>
                                <strong>Entrées / sorties</strong>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>                    
                    <li>
                        <a href="{{ route("reservations.index") }}">
                            <div>
                                <strong>Réservations</strong>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route("units.index") }}">
                            <div>
                                <strong>Unités</strong>
                            </div>
                        </a>
                    </li>  
                </ul>
            </li>                               
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Lieux <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route("info.places.index") }}">
                            <div>
                                <strong>Infos journalières</strong>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>                        
                    <li>
                        <a href="{{ route("places.index") }}">
                            <div>
                                <strong>Gérer les lieux</strong>
                            </div>
                        </a>
                    </li>                    
                    <li class="divider"></li>                        
                    <li>
                        <a href="{{ route("limits.index") }}">
                            <div>
                                <strong>Gérer les limites</strong>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>        
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Evénements <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">                     
                    <li>
                        <a href="{{ route("events.index") }}">
                            <div>
                                <strong>Liste</strong>
                            </div>
                        </a>
                    </li>
                    
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route("event.create") }}">
                            <div>
                                <strong>Ajouter</strong>
                            </div>
                        </a>
                    </li>
                    
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route("colors.index") }}">
                            <div>
                                <strong>Couleurs</strong>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>                            
            <li>
                <a href="{{ route("links.index") }}"> ownCloud </a>
            </li> 
            <li>
                <a href="{{ route("contacts.index") }}"> Contacts </a>
            </li>              
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ route("user.itself")}}"><i class="fa fa-user fa-fw"></i> Profil</a>
                    </li>
                    @can('see-users')
                    <li class="divider"></li>                    
                    <li><a href="{{ route("users.index")}}"><i class="fa fa-users fa-fw"></i> Utilisateurs</a>
                    </li>
                    @endcan
                    <li class="divider"></li>
                    <li><a href="{{ route("logout") }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
