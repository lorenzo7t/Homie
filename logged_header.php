<div class="header-container header-bg">
    <div class="header fixed-width">
        <div class="header-right">
            <a href="index.php" class="logo-container">
                <img class="logo" src="img/logo_new.png">
            </a>
            <div class="search-container">
                <form action="search.php" method="GET">
                    <input type="text" name="search" id="search" class="search-bar" placeholder="Cerca..." autocomplete="off">
                    <button type="submit" class="search-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
        <div class="header-left">
            <div class="user-menu">
                <button class="user-button">
                    <span class="username">Nome Utente</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </button>
                <div class="dropdown-content">
                    <a href="profile.php">Profilo</a>
                    <a href="orders.php">Ordini</a>
                    <a href="logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 8v-2a4 4 0 0 0 -4 -4h-5v16h5a4 4 0 0 0 4 -4v-2" />
                            <path d="M7 12h14l-3 -3m0 6l3 -3" />
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
            <div class="help-icon-container">
                <div class="help-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="#333" id="question-mark">
                        <circle cx="12" cy="12" r="10" fill="#F1FAEE" />
                        <text x="50%" y="50%" text-anchor="middle" fill="#333" font-size="16" font-family="Arial" dy=".3em">?</text>
                    </svg>
                </div>
            </div>
        </div>

    </div>
</div>