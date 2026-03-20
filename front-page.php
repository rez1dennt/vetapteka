<?php
/**
 * Front page template — ВЕТАПТЕКА.ПРО
 */

get_header();
$tpl = get_template_directory_uri();
?>

  <main id="main-content">

    <!-- ========== HERO ========== -->
    <section class="hero" id="hero" aria-label="Главный экран">
      <div class="hero-bg" aria-hidden="true"></div>
      <div class="hero-overlay" aria-hidden="true"></div>
      <div class="container hero-content">
        <p class="hero-eyebrow">Компаундинг · Москва</p>
        <h1 class="hero-title">Препараты для<br>питомцев, которых<br><em>нет в аптеке</em></h1>
        <p class="hero-subtitle">Изготавливаем лекарства по рецепту ветеринара — нужная доза, подходящий вкус, удобная форма. Для кошек, собак, лошадей и экзотов.</p>
        <a class="btn btn-gold hero-btn" href="tel:+79168096136">
          <?php echo vetapteka_phone_svg( 18 ); ?>
          Позвонить и заказать
        </a>
      </div>
      <div class="hero-scroll" aria-hidden="true">
        <div class="hero-scroll-line"></div>
      </div>
    </section>

    <!-- ========== MARQUEE TICKER ========== -->
    <div class="marquee-band" aria-hidden="true">
      <div class="marquee-track">
        <span>Компаундинг</span><span class="mq-sep">✦</span>
        <span>Рецепты</span><span class="mq-sep">✦</span>
        <span>Доставка по России</span><span class="mq-sep">✦</span>
        <span>Лицензия Россельхознадзора</span><span class="mq-sep">✦</span>
        <span>Жидкие формы</span><span class="mq-sep">✦</span>
        <span>Дерматология</span><span class="mq-sep">✦</span>
        <span>Твёрдые формы</span><span class="mq-sep">✦</span>
        <span>Индивидуальный подход</span><span class="mq-sep">✦</span>
        <span>Компаундинг</span><span class="mq-sep">✦</span>
        <span>Рецепты</span><span class="mq-sep">✦</span>
        <span>Доставка по России</span><span class="mq-sep">✦</span>
        <span>Лицензия Россельхознадзора</span><span class="mq-sep">✦</span>
        <span>Жидкие формы</span><span class="mq-sep">✦</span>
        <span>Дерматология</span><span class="mq-sep">✦</span>
        <span>Твёрдые формы</span><span class="mq-sep">✦</span>
        <span>Индивидуальный подход</span><span class="mq-sep">✦</span>
      </div>
    </div>

    <!-- ========== О НАС ========== -->
    <section class="about" id="about" aria-labelledby="about-title">
      <div class="container about-inner">
        <div class="about-image-wrap">
          <img
            src="<?php echo esc_url( $tpl ); ?>/images/photo-1576201836106-db1758fd1c97.png"
            alt="Ветеринар осматривает собаку — внимательный подход к каждому пациенту"
            loading="lazy"
            width="900" height="600"
            class="about-img"
          >
          <div class="about-badge" aria-hidden="true">
            <span class="about-badge-num">10+</span>
            <span class="about-badge-text">лет опыта</span>
          </div>
        </div>
        <div class="about-text-wrap">
          <div class="section-header" data-num="01">
            <span class="label">Кто мы</span>
            <h2 class="section-title" id="about-title">Делаем то, чего<br>нет в обычной аптеке</h2>
          </div>
          <p class="about-p">Иногда нужный препарат просто недоступен: нет нужной дозировки, неподходящая форма, животное отказывается принимать. Мы решаем именно эти задачи.</p>
          <p class="about-p">Наш фармацевтический компаундинг изготавливает препараты по рецептам ветеринаров — с точным расчётом дозы под вес, вид и состояние животного. Работаем официально, по лицензии Россельхознадзора.</p>
          <ul class="about-features" aria-label="Наши преимущества">
            <li class="about-feature">
              <span class="feature-dot" aria-hidden="true">✦</span>
              Лицензия Россельхознадзора №Л042-00118-77/03607161
            </li>
            <li class="about-feature">
              <span class="feature-dot" aria-hidden="true">✦</span>
              Доставка по всей России — курьером или транспортной компанией
            </li>
            <li class="about-feature">
              <span class="feature-dot" aria-hidden="true">✦</span>
              Срок изготовления — от 3 до 5 рабочих дней
            </li>
            <li class="about-feature">
              <span class="feature-dot" aria-hidden="true">✦</span>
              Жидкие, твёрдые и дерматологические формы, любые вкусы
            </li>
          </ul>
        </div>
      </div>
    </section>

    <!-- ========== STATS STRIP ========== -->
    <div class="stats-strip" aria-label="Наша статистика">
      <div class="container stats-inner">
        <div class="stat-item">
          <span class="stat-num">10<sup>+</sup></span>
          <span class="stat-label">лет на рынке</span>
        </div>
        <div class="stat-sep" aria-hidden="true"></div>
        <div class="stat-item">
          <span class="stat-num">500<sup>+</sup></span>
          <span class="stat-label">рецептов в месяц</span>
        </div>
        <div class="stat-sep" aria-hidden="true"></div>
        <div class="stat-item">
          <span class="stat-num">12+</span>
          <span class="stat-label">форм препаратов</span>
        </div>
        <div class="stat-sep" aria-hidden="true"></div>
        <div class="stat-item">
          <span class="stat-num">∞</span>
          <span class="stat-label">забота о питомцах</span>
        </div>
      </div>
    </div>

    <!-- ========== НАШИ УСЛУГИ ========== -->
    <section class="section-dark services" id="services" aria-labelledby="services-title">
      <div class="container">
        <div class="section-header" data-num="02">
          <span class="label label-center">Что мы делаем</span>
          <h2 class="section-title section-title-center" id="services-title">Наши услуги</h2>
        </div>
        <div class="cards-grid" role="list">

          <article class="card" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/services-recipes.jpg"
                alt="Ветеринар выписывает рецепт на индивидуальный препарат"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Рецепты</h3>
              <p class="card-desc">Создаём препараты с учётом веса и особенностей вашего любимца по ветеринарному рецепту.</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

          <article class="card" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/services-flavors.jpg"
                alt="Питомец с удовольствием принимает препарат с приятным вкусом"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Вкусы</h3>
              <p class="card-desc">Подбираем вкусные добавки, чтобы лечение стало приятным лакомством для питомца.</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

          <article class="card" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/services-doses.jpg"
                alt="Точное взвешивание и дозирование лекарственного препарата"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Дозы</h3>
              <p class="card-desc">Точные дозировки, рассчитанные специально под вес и физиологию вашего животного.</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

        </div>
      </div>
    </section>

    <!-- ========== НАШИ РЕШЕНИЯ ========== -->
    <section class="solutions" id="solutions" aria-labelledby="solutions-title">
      <div class="container">
        <div class="section-header" data-num="03">
          <span class="label label-center">Формы препаратов.</span>
          <h2 class="section-title section-title-center" id="solutions-title">Наши решения</h2>
        </div>
        <div class="cards-grid cards-grid-alt" role="list">

          <article class="card card-light" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/solutions-liquid.jpg"
                alt="Жидкие лекарственные формы — суспензии и растворы для животных"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Жидкие формы</h3>
              <p class="card-desc">Индивидуальные суспензии, пасты, растворы, капли, настои.</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

          <article class="card card-light" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/solutions-derma.jpg"
                alt="Изготовление дерматологического препарата в лаборатории"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Дерматология</h3>
              <p class="card-desc">Крема, мази, гели, присыпки, порошки.</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

          <article class="card card-light" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/solutions-solid.jpg"
                alt="Твёрдые формы препаратов — таблетки и капсулы для животных"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Твёрдые формы</h3>
              <p class="card-desc">Жевательные таблетки, суппозитории, болюсы, порошки, пилюли.</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

        </div>
      </div>
    </section>

    <!-- ========== ИНДИВИДУАЛЬНЫЙ ПОДХОД ========== -->
    <section class="approach section-dark" id="approach" aria-labelledby="approach-title">
      <div class="container">
        <div class="section-header" data-num="04">
          <span class="label label-center">Для кого мы работаем</span>
          <h2 class="section-title section-title-center" id="approach-title">Индивидуальный подход к лечению</h2>
          <p class="section-subtitle">Наш подход к компаундингу позволяет создавать лекарства, которые идеально подходят под физиологию и вес вашего животного, обеспечивая наилучший лечебный эффект.</p>
        </div>
        <div class="cards-grid" role="list">

          <article class="card" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/approach-clinics.jpg"
                alt="Ветеринарная клиника — профессиональные компаундинговые препараты"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Ветеринарным клиникам</h3>
              <p class="card-desc">Ветеринарным клиникам: работаем с малыми и большими дозами, изготавливаем сложные препараты</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

          <article class="card" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/approach-breeders.jpg"
                alt="Заводчики и питомники — препараты для здоровья всего помёта"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Заводчикам</h3>
              <p class="card-desc">Работаем с питомниками и племенными хозяйствами: профилактика, поддержание здоровья, улучшение фертильности.</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

          <article class="card" role="listitem">
            <div class="card-img-wrap">
              <img
                src="<?php echo esc_url( $tpl ); ?>/images/approach-owners.jpg"
                alt="Владелец даёт питомцу лекарство — индивидуальный подход к лечению"
                loading="lazy" width="640" height="430"
                class="card-img"
              >
            </div>
            <div class="card-body">
              <h3 class="card-title">Владельцам животных</h3>
              <p class="card-desc">Владельцам: ваш питомец плохо переносит инъекции? Мы сделаем суспензию с любимым вкусом. Нужна точная дозировка по весу? Или есть хронические болезни и много лекарств? Упростим схему приема, и сделаем препарат точно для вашего любимца!</p>
              <a class="btn btn-gold btn-sm" href="tel:+79168096136">
                <?php echo vetapteka_phone_svg( 15 ); ?>
                Заказать
              </a>
            </div>
          </article>

        </div>
      </div>
    </section>

    <?php get_template_part( 'template-parts/showcase/index' ); ?>

    <!-- ========== СЕРТИФИКАТ ========== -->
    <section class="certificate" id="certificate" aria-labelledby="certificate-title">
      <div class="container certificate-inner">

        <div class="certificate-img-col">
          <button
            class="cert-btn"
            id="cert-btn"
            type="button"
            aria-label="Открыть лицензию в полном размере"
            data-src="<?php echo esc_url( $tpl ); ?>/images/certificate.webp"
            data-alt="Лицензия Россельхознадзора №Л042-00118-77/03607161"
          >
            <img
              src="<?php echo esc_url( $tpl ); ?>/images/certificate.webp"
              alt="Лицензия Россельхознадзора №Л042-00118-77/03607161 на фармацевтическую деятельность"
              loading="lazy"
              width="640" height="460"
              class="cert-img"
            >
            <div class="cert-zoom-hint" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                <line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/>
              </svg>
              <span>Нажмите для просмотра</span>
            </div>
          </button>
        </div>

        <div class="certificate-text-col">
          <div class="section-header" data-num="06">
            <span class="label">Лицензия</span>
            <h2 class="section-title" id="certificate-title">Сертифицированная аптека</h2>
          </div>
          <p class="cert-p">Мы работаем строго по лицензии Россельхознадзора, обеспечивая высочайшее качество каждого изготовленного препарата для здоровья ваших питомцев.</p>
          <dl class="cert-details">
            <div class="cert-row">
              <dt>Номер лицензии:</dt>
              <dd>Л042-00118-77/03607161</dd>
            </div>
            <div class="cert-row">
              <dt>Срок действия:</dt>
              <dd>Бессрочная</dd>
            </div>
            <div class="cert-row">
              <dt>Дата выдачи:</dt>
              <dd>24.10.2025</dd>
            </div>
            <div class="cert-row">
              <dt>Статус:</dt>
              <dd class="cert-status">Действует</dd>
            </div>
          </dl>
          <a class="btn btn-gold" href="tel:+79168096136">Заказать препарат</a>
        </div>

      </div>
    </section>

    <!-- ========== КОНТАКТЫ ========== -->
    <section class="contacts section-dark" id="contacts" aria-labelledby="contacts-title">
      <div class="container contacts-inner">
        <div class="contacts-text-col">
          <div class="section-header" data-num="07">
            <span class="label">Где нас найти</span>
            <h2 class="section-title" id="contacts-title">Контакты</h2>
          </div>
          <address class="contacts-addr">
            <div class="contact-row">
              <span class="contact-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
              </span>
              <div>
                <strong>Наш адрес</strong>
                <p>г. Москва, ул. Алма-Атинская, д. 9, к. 2</p>
              </div>
            </div>
            <div class="contact-row">
              <span class="contact-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="1" y="3" width="15" height="13"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/>
                  <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
              </span>
              <div>
                <strong>Доставка</strong>
                <p>Работаем в формате доставки по всей России</p>
              </div>
            </div>
            <div class="contact-row">
              <span class="contact-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.28-1.29a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
              </span>
              <div>
                <strong>Телефон</strong>
                <a class="contact-phone" href="tel:+79168096136">+7 (916) 809-61-36</a>
              </div>
            </div>
          </address>
        </div>
        <div class="contacts-map-col">
          <iframe
            src="https://yandex.ru/map-widget/v1/?ll=37.772927%2C55.639380&z=16&l=map&pt=37.772927%2C55.639380,pm2rdm"
            width="100%"
            height="380"
            frameborder="0"
            allowfullscreen
            title="Расположение ветеринарной аптеки ВЕТАПТЕКА.ПРО на карте Москвы"
            loading="lazy"
            class="contacts-map"
          ></iframe>
        </div>
      </div>
    </section>

    <!-- ========== CTA ========== -->
    <section class="cta-banner" id="cta" aria-labelledby="cta-title">
      <div class="container cta-inner">
        <h2 class="cta-title" id="cta-title">Ветеринар выписал рецепт? Мы сами свяжемся с ним и уточним дозировки!</h2>
        <p class="cta-text">
          Звоните — и через 3–5 дней нужный препарат будет у вас.
          <a class="cta-link" href="tel:+79168096136">+7 (916) 809-61-36</a>
        </p>
      </div>
    </section>

    <!-- ========== ЧАСТЫЕ ВОПРОСЫ ========== -->
    <section class="faq section-dark" id="faq" aria-labelledby="faq-title">
      <div class="container">
        <div class="section-header" data-num="08">
          <span class="label label-center">Вопросы и ответы</span>
          <h2 class="section-title section-title-center" id="faq-title">Частые вопросы</h2>
          <p class="section-subtitle">Ответы на самые частые вопросы о нашей работе.</p>
        </div>

        <div class="faq-list">

          <div class="faq-item">
            <button class="faq-q" type="button" aria-expanded="false" aria-controls="faq-a-1">
              <span>Как сделать заказ?</span>
              <span class="faq-icon" aria-hidden="true"></span>
            </button>
            <div class="faq-a" id="faq-a-1" role="region">
              <div class="faq-a-inner">
                <p>Позвоните нам по номеру <a href="tel:+79168096136">+7 (916) 809-61-36</a> и расскажите о питомце и рецепте ветеринара. Мы уточним вид животного, вес, нужную форму и вкус — и рассчитаем итоговую стоимость. Никаких лишних шагов: всё решается по телефону за несколько минут.</p>
              </div>
            </div>
          </div>

          <div class="faq-item">
            <button class="faq-q" type="button" aria-expanded="false" aria-controls="faq-a-2">
              <span>Вы работаете официально?</span>
              <span class="faq-icon" aria-hidden="true"></span>
            </button>
            <div class="faq-a" id="faq-a-2" role="region">
              <div class="faq-a-inner">
                <p>Да. Мы работаем по лицензии Россельхознадзора №Л042-00118-77/03607161 на фармацевтическую деятельность. Лицензия бессрочная, статус — действует. Ознакомиться с ней можно в разделе <a href="#certificate">«Сертифицированная аптека»</a>.</p>
              </div>
            </div>
          </div>

          <div class="faq-item">
            <button class="faq-q" type="button" aria-expanded="false" aria-controls="faq-a-3">
              <span>В каких формах вы изготавливаете препараты?</span>
              <span class="faq-icon" aria-hidden="true"></span>
            </button>
            <div class="faq-a" id="faq-a-3" role="region">
              <div class="faq-a-inner">
                <p>Мы изготавливаем жидкие формы (суспензии, растворы, капли), дерматологические средства (кремы, мази, гели), а также твёрдые формы — жевательные таблетки, порошки, суппозитории. Возможны любые вкусовые добавки для удобного приёма.</p>
              </div>
            </div>
          </div>

          <div class="faq-item">
            <button class="faq-q" type="button" aria-expanded="false" aria-controls="faq-a-4">
              <span>Сколько времени занимает изготовление?</span>
              <span class="faq-icon" aria-hidden="true"></span>
            </button>
            <div class="faq-a" id="faq-a-4" role="region">
              <div class="faq-a-inner">
                <p>Стандартный срок изготовления — 3–5 рабочих дней. При срочных запросах свяжитесь с нами напрямую. Доставка по Москве — в течение 1 дня, по России — согласно срокам транспортной компании.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
