@extends('layouts/app')

@section('title', 'Офисы')
@section('modificator', 'page-offices')

@section('content')
    <div class="b-about-offices">
        <h1 class="heading">Офисы</h1>
        <div class="b-typo">
            <p>Просторные офисы на главном пешеходном бульваре столицы - Нуржол.</p>
            <p>Бизнес-центр и прилегающая территория контролируются электронной системой безопасности. Для арендаторов и
                гостей доступна парковка и места в четырехуровневом паркинге.</p>
        </div>
    </div>
    @if($offices->count())
    <div class="b-available-offices js-offices-slider">
        <div class="actual-info js-generated-slide">
            <h2 class="heading b-heading modificator-with-digit"><span class="digit js-offices-amount"></span> <span
                        class="heading">свободных офиса</span></h2>
            <ul class="info js-info">
                <li class="info-item">
                    <span class="key">Этаж</span>
                    <span class="value js-value-floor"></span>
                </li>
                <li class="info-item">
                    <span class="key">Площадь (м<sup>2</sup>)</span>
                    <span class="value js-value-square1"></span>
                </li>
                <li class="info-item">
                    <span class="key">С учетом вспомогательной площади</span>
                    <span class="value js-value-square2"></span>
                </li>
                <li class="info-item">
                    <span class="key">Коэффициент вспомогательной площади</span>
                    <span class="value js-value-square3"></span>
                </li>
            </ul>
            <div class="image-slider">
                <div class="slider js-slider"></div>
            </div>
            <ul class="controls">
                <li class="controls-item">
                    <a href="#" class="b-button js-plane-link"><span class="value">Планировка</span></a>
                </li>
                <li class="controls-item">
                    <button type="button" class="b-button-with-icon js-order-button">
                        <span class="icon-phone-call"></span>
                        <span class="value"><span class="value-inner">Забронировать</span></span>
                    </button>
                </li>
            </ul>
            <ul class="offices js-offices-navigation"></ul>
        </div>
        <div class="data js-data">
            @foreach($offices as $office)
                <div class="js-data-item">
                    <span class="js-value-id" data-value="{{$office->id}}"></span>
                    <h4 class="number">Кабинет <span class="js-value-number"
                                                     data-value="{{$office->number}}">{{$office->number}}</span></h4>
                    <ul class="params">
                        <li class="info-item">
                            <span class="key">Этаж</span>
                            <span class="value js-value-floor" data-value="{{$office->floor}}">{{$office->floor}}</span>
                        </li>
                        <li class="info-item">
                            <span class="key">Площадь (м<sup>2</sup>)</span>
                            <span class="value js-value-square1" data-value="{{$office->area}}">{{$office->area}}</span>
                        </li>
                        <li class="info-item">
                            <span class="key">С учетом вспомогательной площади</span>
                            <span class="value js-value-square2"
                                  data-value="{{$office->auxiliary_area}}">{{$office->auxiliary_area}}</span>
                        </li>
                        <li class="info-item">
                            <span class="key">Коэффициент вспомогательной площади</span>
                            <span class="value js-value-square3" data-value="{{$office->coefficient_auxiliary_area}}">
                                {{$office->coefficient_auxiliary_area}}</span>
                        </li>
                    </ul>
                    <ul class="image js-value-images">
                        @foreach($office->officeImages as $officeImage)
                            @if($officeImage->image)
                                <li><img src="{{url($officeImage->image->getThumb())}}"></li>
                            @endif
                        @endforeach
                    </ul>
                    <div>
                        <a href="{{url($office->file ? $office->file->getFile() : '')}}" target="_blank" class="b-button js-value-plane-link"><span class="value">Планировка</span></a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="b-popup js-order-form">
            <h3 class="b-heading">Оставить заявку на бронь</h3>
            <h4 class="b-heading cabinet-number">Кабинет <span class="js-cabinet-number"></span></h4>
            <button class="close js-popup-close">Закрыть попап</button>
            <div class="form">
                <form action="/offices/reservation" method="post">
                <div class="actual-form">
                    {{csrf_field()}}
                    {{Form::hidden('office_id','', ['id' => 'office_id'])}}
                    <div class="block name">
                        <input type="text" name="name" placeholder="Ф.И.О.">
                    </div>
                    <div class="block company">
                        <input type="text" name="company" placeholder="Компания">
                    </div>
                    <div class="block message">
                        <textarea name="message" placeholder="Сообщение"></textarea>
                    </div>
                    <div class="block submit">
                        <button type="submit" class="b-button-with-icon">
                            <span class="icon-phone-call"></span>
                            <span class="value"><span class="value-inner">Подобрать офис</span></span>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

        @else

        <h2 class="heading b-heading modificator-with-digit"><span class="digit js-offices-amount">0</span> <span
                    class="heading">свободных офиса</span></h2>

        <p> В данный момент в здании Бизнес-центра нет свободных офисов, но вы всегда можете оставить заявку. Выберите интересующие параметры для офиса, мы сохраним ваши контакты и свяжемся при наличии интересующих вас.
        </p>

        <div class="b-feedback-form sr-reveal">
            <h2 class="b-heading">Оставить заявку</h2>
            <div class="form">
                <form class="actual-form" action="/offices/new-order" method="post">
                    {{csrf_field()}}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="block square">
                        {{Form::select('area', ['50 - 100' =>'50 - 100',
                        '100 - 150' => '100 - 150',
                        '150 - 200' => '150 - 200',
                        '200 - 250' => '200 - 250',
                        '250 - 300' => '250 - 300'
                        ], '',
                        ['placeholder' => 'Площадь'])}}
                    </div>
                    <div class="block name">
                        {{Form::text('name', '', ['placeholder' => 'Ф.И.О.'])}}
                    </div>
                    <div class="block company">
                        {{Form::text('company', '', ['placeholder' => 'Компания'])}}
                    </div>
                    <div class="block amount-of-cabinets">
                        <div>Количество кабинетов</div>
                        <ul class="radio-buttons-section">
                            <li class="radio-item">
                                <input type="radio" id="cabinets1" value="1" name="cabinets-group" checked>
                                <label class="radio-label" for="cabinets1">1</label>
                            </li>
                            <li class="radio-item">
                                <input type="radio" id="cabinets2" value="2" name="cabinets-group">
                                <label class="radio-label" for="cabinets2">2</label>
                            </li>
                            <li class="radio-item">
                                <input type="radio" id="cabinets3" value="3" name="cabinets-group">
                                <label class="radio-label" for="cabinets3">3</label>
                            </li>
                            <li class="radio-item">
                                <input type="radio" id="cabinets4" value="4" name="cabinets-group">
                                <label class="radio-label" for="cabinets4">4</label>
                            </li>
                            <li class="radio-item">
                                <input type="radio" id="cabinets5+" value="5+" name="cabinets-group">
                                <label class="radio-label" for="cabinets5+">5+</label>
                            </li>
                        </ul>
                    </div>
                    <div class="block message">
                        {{Form::textarea('message', '', ['placeholder' => 'Сообщение'])}}
                    </div>
                    <div class="block submit">
                        <button type="submit" class="b-button-with-icon">
                            <span class="icon-phone-call"></span>
                            <span class="value"><span class="value-inner">Подобрать офис</span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="b-features">
        <h2 class="b-heading sr-reveal">Условия для арендаторов</h2>
        <ul class="features-list">
            <li class="features-item">
                <span class="icon-parking-sign"></span>
                <span class="label">Охраняемый паркинг</span>
            </li>
            <li class="features-item">
                <span class="icon-headphones"></span>
                <span class="label">Бронирование инфраструктуры здания</span>
            </li>
            <li class="features-item">
                <span class="icon-login"></span>
                <span class="label">Личный кабинет на сайте</span>
            </li>
            <li class="features-item">
                <span class="icon-cleaning"></span>
                <span class="label">Техническое обслуживание и уборка</span>
            </li>
        </ul>
    </div>

@endsection

@section('js')
    <script src="/js/offices-slider.js"></script>
    <script src="/js/offices.js"></script>
@endsection
