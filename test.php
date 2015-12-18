<?php
/* 
	CMS 0.1
*/

//the path to the installed dir
define( 'ABSPATH', dirname(__FILE__) . '/' );
//set up the constants, clases and functions
require_once (ABSPATH . 'util/includes.php');


//there is going to be more here for handling errors




/*************************************
		START Header Data
*************************************/
$pageTitle = "Logically Intuitive";
$otherHeaderIncludes = "";

require_once (PAGESPATH . 'header.php');
/*************************************
		END Header Data
*************************************/

?>
        
        <div class='row headerSection'>
            <div class='container'>
                <h1>Typography and Formatting Test</h1>
            </div>
        </div>

        <div class='container'>
            <div class='col-md-12'>
                <div class='col-md-4'>
                    <h3>Random Paragraphs</h3>
                    <p>Pariatur comprehenderit ad quamquam an mandaremus hic quorum incididunt aut ubi 
                        eram elit ne tempor et incididunt te quem. Hic expetendis firmissimum, velit e 
                        consequat id legam, irure iudicem in enim veniam e probant aliqua sunt o ipsum 
                        et nostrud an quem offendit, quo in dolor voluptate, quid sed sed malis 
                        excepteur, ut veniam noster ita nostrud.</p>
                    <p>Multos quo et quorum cupidatat, vidisse amet pariatur, ipsum nostrud est 
                        distinguantur in multos despicationes voluptate tamen singulis aut expetendis 
                        labore fore ex sint, do quae commodo cernantur o qui varias labore culpa iudicem 
                        ne appellat summis singulis. </p>
                </div>
                <div class='col-md-4'>
                    <h3>Random paragraphs with lead</h3>
                    <p class='lead'>Aute probant quo quid ipsum, de arbitror ea eram consectetur.</p>
                    <p>Est quem quem elit eiusmod, ad ubi coniunctione, ne ad praetermissum de iudicem 
                        culpa dolore eu nulla. Ea do sunt incididunt. </p>
                    <p>Nulla se quibusdam id mentitum magna vidisse laborum de ne duis amet ex nostrud 
                        iis officia quorum aliquip laborum. Sunt exercitation fabulas enim deserunt, </p>
                </div>
                <div class='col-md-4'>
                    <h3>Headings</h3>
                    <h1>h1. Heading 1</h1>
                    <h2>h2. Heading 2</h2>
                    <h3>h3. Heading 3</h3>
                    <h4>h4. Heading 4</h4>
                    <h5>h5. Heading 5</h5>
                    <h6>h6. Heading 6</h6>
                </div>
            </div>
        </div>
        <div class='container'>
            <div class='col-md-12'>
                <div class='col-md-4'>
                    <h3>Unordered Lists</h3>
                    <ul>
                        <li>Lorem ipsum dolor sit amet</li>
                        <li>Consectetur adipiscing elit</li>
                        <li>Integer molestie lorem at massa</li>
                        <li>Facilisis in pretium nisl aliquet</li>
                        <li>
                            Nulla volutpat aliquam velit
                            <ul>
                                <li>Phasellus iaculis neque</li>
                                <li>Purus sodales ultricies</li>
                                <li>Vestibulum laoreet porttitor sem</li>
                                <li>Ac tristique libero volutpat at</li>
                            </ul>
                        </li>
                        <li>Faucibus porta lacus fringilla vel</li>
                        <li>Aenean sit amet erat nunc</li>
                        <li>Eget porttitor lorem</li>
                    </ul>
                </div>
                <div class='col-md-4'>
                    <h3>Ordered Lists</h3>
                    <ol>
                        <li>Lorem ipsum dolor sit amet</li>
                        <li>Consectetur adipiscing elit</li>
                        <li>Integer molestie lorem at massa</li>
                        <li>Facilisis in pretium nisl aliquet</li>
                        <li>Nulla volutpat aliquam velit</li>
                        <li>Faucibus porta lacus fringilla vel</li>
                        <li>Aenean sit amet erat nunc</li>
                        <li>Eget porttitor lorem</li>
                    </ol>
                </div>
                <div class='col-md-4'>
                    <h3>Description Lists</h3>
                    <dl>
                        <dt>Description lists</dt>
                        <dd>A description list is perfect for defining terms.</dd>
                        <dt>Euismod</dt>
                        <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                        <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                        <dt>Malesuada porta</dt>
                        <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class='headerSection'>
            <div class='container'>
                <h1>h1 headerSection with container</h1>
            </div>
        </div>

        <div class='headerSection'>
            <div class='container'>
                <h2>h2 headerSection with container</h2>
            </div>
        </div>



        <div class='container'>
            <div class='col-md-12'>
                <h3>Blockquote</h3>
                <blockquote>Tamen ex excepteur ex do varias ad ipsum. Arbitror varias singulis tempor qui 
                    cupidatat legam admodum. Eiusmod lorem est incididunt imitarentur. Laborum e 
                    commodo, multos singulis te incurreret ab id labore iudicem appellat te labore 
                    incurreret an veniam elit qui aute doctrina sed arbitror id quis se se nulla 
                    consequat ab fabulas nulla ipsum an irure ad quibusdam exquisitaque qui fabulas. 
                    Malis ea laborum, eiusmod eram ullamco laborum. Quem expetendis nostrud, eu 
                    magna enim lorem fabulas aut ut amet philosophari an ut duis cernantur voluptate 
                    an doctrina quem o nostrud graviterque ab ullamco do iudicem, consequat id eram 
                    ut ingeniis multos an aliquip arbitrantur. Aliquip sed commodo, consequat aute 
                    aliquip.</blockquote>
            </div>
        </div>

        <div class='container'>
            <div class='col-md-12'>
                <h3>Blockquote</h3>
                <blockquote>Tamen ex excepteur ex do varias ad ipsum. Arbitror varias singulis tempor qui 
                    cupidatat legam admodum. Eiusmod lorem est incididunt imitarentur. Laborum e 
                    commodo, multos singulis te incurreret ab id labore iudicem appellat te labore 
                    incurreret an veniam elit qui aute doctrina sed arbitror id quis se se nulla 
                    consequat ab fabulas nulla ipsum an irure ad quibusdam exquisitaque qui fabulas. 
                    Malis ea laborum, eiusmod eram ullamco laborum. Quem expetendis nostrud, eu 
                    magna enim lorem fabulas aut ut amet philosophari an ut duis cernantur voluptate 
                    an doctrina quem o nostrud graviterque ab ullamco do iudicem, consequat id eram 
                    ut ingeniis multos an aliquip arbitrantur. Aliquip sed commodo, consequat aute 
                    aliquip.</blockquote>
            </div>
        </div>
        <div class='col-md-12 '>
            <div class='container'>
                <h3>buttons</h3>
                
                <button type="button" class="btn btn-default">Default</button>
                <button type="button" class="btn btn-primary">Primary</button>
                <button type="button" class="btn btn-success">Success</button>
                <button type="button" class="btn btn-info">Info</button>
                <button type="button" class="btn btn-warning">Warning</button>
                <button type="button" class="btn btn-danger">Danger</button>
                <button type="button" class="btn btn-link">Link</button>
                
                <br>
                <br>
                <div class="btn-group">
                    <button type="button" class="btn btn-default">Left</button>
                    <button type="button" class="btn btn-default">Middle</button>
                    <button type="button" class="btn btn-default">Right</button>
                </div>
                
            </div>
        </div>
		


<?php


/*************************************
		START Footer Data
*************************************/

require_once (PAGESPATH . 'footer.php');
/*************************************
		END Footer Data
*************************************/