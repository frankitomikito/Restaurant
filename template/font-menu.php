<section class="ftco-section bg-light" ng-controller="MenuController">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Our Menu</span>
            <h2>Discover Our Exclusive Menu</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 dish-menu">

            <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link py-3 px-4 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-main" role="tab" aria-controls="v-pills-home" aria-selected="true"><span class="flaticon-meat"></span> Main</a>
              <a class="nav-link py-3 px-4" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-dessert" role="tab" aria-controls="v-pills-profile" aria-selected="false"><span class="flaticon-cutlery"></span> Dessert</a>
              <a class="nav-link py-3 px-4" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-drinks" role="tab" aria-controls="v-pills-messages" aria-selected="false"><span class="flaticon-cheers"></span> Drinks</a>
              <a class="nav-link py-3 px-4" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-special" role="tab" aria-controls="v-pills-messages" aria-selected="false"><span class="flaticon-cheers"></span> Special</a>
            </div>

            <div class="tab-content py-5" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-main" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                  <div class="col-lg-6" ng-repeat="menu in menus | filter: {category_id:1}" style="cursor: pointer;">
                    <div id="menu-{{menu.menu_id}}" <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 2) echo 'ng-click="onClickMenu(menu, $event.currentTarget)"' ?> class="menus d-flex main-dish">
                      <div class="menu-img" style="background-image: url(admin/item-image/{{menu.image_path}});"></div>
                      <div class="text d-flex">
                        <div class="one-half">
                          <h3>{{menu.name}}</h3>
                          <p>{{menu.description}}</p>
                        </div>
                        <div class="one-forth">
                          <span class="price">Php {{menu.price}}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="col-lg-6">
                    <div class="menus d-flex ftco-animate">
                      <div class="menu-img" style="background-image: url(images/dish-8.jpg);"></div>
                      <div class="text d-flex">
                        <div class="one-half">
                          <h3>Savory Watercress Chinese Pancakes</h3>
                          <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
                        </div>
                        <div class="one-forth">
                          <span class="price">Php 190.00</span>
                        </div>
                      </div>
                    </div>
                    <div class="menus d-flex ftco-animate">
                      <div class="menu-img" style="background-image: url(images/dish-9.jpg);"></div>
                      <div class="text d-flex">
                        <div class="one-half">
                          <h3>Soup With Vegetables And Meat</h3>
                          <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
                        </div>
                        <div class="one-forth">
                          <span class="price">Php 250.00</span>
                        </div>
                      </div>
                    </div>
                    <div class="menus d-flex ftco-animate">
                      <div class="menu-img" style="background-image: url(images/dish-10.jpg);"></div>
                      <div class="text d-flex">
                        <div class="one-half">
                          <h3>Udon Noodles With Vegetables</h3>
                          <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
                        </div>
                        <div class="one-forth">
                          <span class="price">Php 130.00</span>
                        </div>
                      </div>
                    </div>
                    <div class="menus d-flex ftco-animate">
                      <div class="menu-img" style="background-image: url(images/dish-11.jpg);"></div>
                      <div class="text d-flex">
                        <div class="one-half">
                          <h3>Baked Lobster With A Garnish</h3>
                          <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
                        </div>
                        <div class="one-forth">
                          <span class="price">Php 290.00</span>
                        </div>
                      </div>
                    </div>
                    <div class="menus d-flex ftco-animate">
                      <div class="menu-img" style="background-image: url(images/dish-100.jpg);"></div>
                      <div class="text d-flex">
                        <div class="one-half">
                          <h3>Marinated Chicken</h3>
                          <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
                        </div>
                        <div class="one-forth">
                          <span class="price">Php 200.00</span>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div><!-- END -->

              <div class="tab-pane fade" id="v-pills-dessert" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="row">
                  <div class="col-lg-6" ng-repeat="menu in menus | filter: {category_id:2}" style="cursor: pointer;">
                      <div id="menu-{{menu.menu_id}}" <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 2) echo 'ng-click="onClickMenu(menu, $event.currentTarget)"' ?> class="menus d-flex main-dish">
                        <div class="menu-img" style="background-image: url(admin/item-image/{{menu.image_path}});"></div>
                        <div class="text d-flex">
                          <div class="one-half">
                            <h3>{{menu.name}}</h3>
                            <p>{{menu.description}}</p>
                          </div>
                          <div class="one-forth">
                            <span class="price">Php {{menu.price}}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div><!-- END -->

              <div class="tab-pane fade" id="v-pills-drinks" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <div class="row">
                  <div class="col-lg-6" ng-repeat="menu in menus | filter: {category_id:3}" style="cursor: pointer;">
                      <div id="menu-{{menu.menu_id}}" <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 2) echo 'ng-click="onClickMenu(menu, $event.currentTarget)"' ?> class="menus d-flex main-dish">
                        <div class="menu-img" style="background-image: url(admin/item-image/{{menu.image_path}});"></div>
                        <div class="text d-flex">
                          <div class="one-half">
                            <h3>{{menu.name}}</h3>
                            <p>{{menu.description}}</p>
                          </div>
                          <div class="one-forth">
                            <span class="price">Php {{menu.price}}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-special" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <div class="row">
                  <div class="col-lg-6" ng-repeat="menu in menus | filter: {category_id:4}" style="cursor: pointer;">
                      <div id="menu-{{menu.menu_id}}" <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 2) echo 'ng-click="onClickMenu(menu, $event.currentTarget)"' ?> class="menus d-flex main-dish">
                        <div class="menu-img" style="background-image: url(admin/item-image/{{menu.image_path}});"></div>
                        <div class="text d-flex">
                          <div class="one-half">
                            <h3>{{menu.name}}</h3>
                            <p>{{menu.description}}</p>
                          </div>
                          <div class="one-forth">
                            <span class="price">Php {{menu.price}}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-sm-12 pt-4 text-center ftco-animate">
                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost</p>
                <span><a href="reservation.php" class="btn btn-primary btn-outline-primary p-3">Make a Reservation</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>