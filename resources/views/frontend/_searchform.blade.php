
    <script>
    $(function() {
      $('a.faq_q').click(function(){ $(this).next().toggle(); return false; });
    });
    </script>

    <div class="well body_center blackwell">
      <div class="row">
      <div class="col-md-4">
        <input class="form-control input-lg" type="text" maxlength="32" id="surname" onkeypress="autokey(event)" placeholder="Фамилия">
      </div>
      <div class="col-md-4">
        <input class="form-control input-lg" type="text" maxlength="32" id="name" onkeypress="autokey(event)" placeholder="Имя">
      </div>
      <div class="col-md-4">
        <div class="input-group">
        <input type="text" class="form-control input-lg" maxlength="32" id="patronymic" onkeypress="autokey(event)" placeholder="Отчество">
        <span class="input-group-btn">
          <button class="btn btn-primary btn-lg" type="button" id="buttonsubmit">Go!</button>
        </span>
        
        </div><!-- /input-group -->
      </div>

      </div>
      <a href="#" class="faq_q" style="margin-top:15px;margin-left:20px;font-weight:bold;">Расширенный поиск</a>
      <div class="well faq_a" style="display: none;">
        <div class="row">
          <div class="col-md-4 col-md-offset-1">
            <input class="form-control input-lg" maxlength="32" type="text" id="city" onkeypress="fullautokey(event)" placeholder="Город">
          </div>
          <div class="col-md-4 col-md-offset-2">
            <input class="form-control input-lg" maxlength="16" type="text" id="vuz" onkeypress="fullautokey(event)" placeholder="Краткое название ВУЗа">
            <h4><small>Например: СПбГУ</small></h4>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 col-md-offset-1">
            <input class="form-control input-lg" type="text" id="specialization" onkeypress="fullautokey(event)" placeholder="Специальность">
            <h4><small>Например: 01.03.02</small></h4>
          </div>
          <div class="col-md-7 col-md-offset-1">
            <div class="well">
              <div class="row">

                <div class="col-md-2 col-md-offset-1">
                  <p class="lead">Балл:</p>
                </div>

                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">от</span>
                    <input type="text" class="form-control input-lg" id="from" onkeypress="fullautokey(event)">
                  </div>
                  <h4><small>Включительно</small></h4>
                </div>

                <div class="col-md-4 col-md-offset-1">
                  <div class="input-group">
                    <span class="input-group-addon">до</span>
                    <input type="text" class="form-control input-lg" id="to" onkeypress="fullautokey(event)">
                  </div>
                </div>

              </div>
            </div>
          </div>
          </div>

          <script>
            $("#specialization").mask("99.99.99");
            $("#from").mask("999");
            $("#to").mask("999");
          </script>

          <div class="row">
            <div class="col-md-7 col-md-offset-5">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <button type="button" class="btn btn-primary btn-lg btn-block" id="buttonfullsubmit">Расширенный поиск</button>
                </div>
              </div>
            </div>
          </div>

        </div>


    </div>