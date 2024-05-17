<div class="fixed-width">
    <div class="categories-container">

        <div class="category">
            <button class="category-button" data-category="idraulico">
                <img src="img/idraulico.png" alt="idraulico">
            </button>
            <span class="category-name">Idraulico</span>
        </div>
        <div class="category">
            <button class="category-button" data-category="pittore">
                <img src="img/pittore.png" alt="pittore">
            </button>
            <span class="category-name">Pittore</span>
        </div>
        <div class="category">
            <button class="category-button" data-category="elettricista">
                <img src="img/elettricista.png" alt="elettricista">
            </button>
            <span class="category-name">Elettricista</span>
        </div>
        <div class="category">
            <button class="category-button" data-category="fabbro">
                <img src="img/fabbro.png" alt="fabbro">
            </button>
            <span class="category-name">Fabbro</span>
        </div>
        <div class="category">
            <button class="category-button" data-category="colf">
                <img src="img/colf.png" alt="colf">
            </button>
            <span class="category-name">Colf</span>
        </div>
        <div class="category">
            <button class="category-button" data-category="tuttofare">
                <img src="img/tuttofare.png" alt="tuttofare">
            </button>
            <span class="category-name">Tuttofare</span>
        </div>

    </div>

    <div class="body-container">
        <div class="professionals-container">
            <div class="professionals-container-title">
                <h1>Professionisti</h1>
                <div class="favorites-toggle">
                    <button class="favorites-toggle-button">
                        <label class="favorites-toggle-container">
                            <input type="checkbox">
                            <svg id="Layer_1" version="1.0" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M16.4,4C14.6,4,13,4.9,12,6.3C11,4.9,9.4,4,7.6,4C4.5,4,2,6.5,2,9.6C2,14,12,22,12,22s10-8,10-12.4C22,6.5,19.5,4,16.4,4z"></path>
                            </svg>
                        </label>
                    </button>
                </div>

            </div>
            <ul>
                <div id="loader-container">
                    <div class="loader">
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
                </div>
            </ul>

        </div>

        <div class="map" id="map">
            <div id="loader-container">
                <div class="loader">
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <div id="professional-details" class="hidden">
            <div class="container-1">
                <img id="professional-image" src="img/professionals/cristian-delauretis-piva.jpeg" alt="">
                <div id="professional-internal-details">
                    <h2 id="professional-name">Cristian De Lauretis</h2>
                    <p id="professional-category">Idraulico</p>
                    <p id="professional-address">Via Roma 1, 20100 Milano</p>
                </div>
            </div>
            
            <button onclick="chiudiDettagli()">Chiudi</button>
        </div>
    </div>
</div>