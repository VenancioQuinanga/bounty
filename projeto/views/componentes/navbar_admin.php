<header>
    <nav class="navbar navbar-light bg-light navbar-expand-lg fixed-top pb-3 pt-3">
        <div class="container">
            <a class="navbar-brand me-5 log" href="./">Bounty</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu-links">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu-links">
                <ul class="navbar-nav me-auto"></ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item my-navbar-item pe-4">
                            <a href="./">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
                                </svg>
                                <span class="load-item">Home</span>
                            </a>
                        </li>
                        <li class="nav-item my-navbar-item pe-4">
                            <a href="./perfil">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <span class="load-item">Minha Conta</span>
                            </a>
                        </li>
                        <li class="nav-item my-navbar-item pe-4">
                            <a>
                                <img class="first-closer" src="./public/img/icones/menu-hamburguer.png" id="icon">
                                <span class="load-item">Menu</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <aside>
        <nav id="dropdown">
            <ul>
                <li class="second-closer myHidden">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                        <span>Fechar</span>
                    </a>
                </li>
                <li class="myHidden"><a href="./perfil">Minha conta</a></li>
                <li class="myHidden"><a href="./gerir-usuarios">Usuários</a></li>
                <li class="myHidden"><a href="./gerir-compras">Compras</a></li>
                <li class="myHidden"><a href="./gerir-produtos">Infoprodutos</a></li>
            </ul>
        </nav>
    </aside>
</header>
