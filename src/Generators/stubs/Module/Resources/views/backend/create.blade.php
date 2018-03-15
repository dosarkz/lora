@extends('admin::layouts.app')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Добавить офис</h3>
        </div>

        <div class="box-body">
            @include($module->alias.'::backend.form',compact('model'))
        </div>
    </div>

@endsection


@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.css">
    <style>
        .upload-demo-wrap {
            width: 350px;
            height: 300px;
            margin: 0 auto;
        }
    </style>
    <link rel="stylesheet" href="/vendor/admin/bootstrap/css/bootstrap-toggle.css">
    <link rel="stylesheet" href="/vendor/admin/datepicker/datepicker3.css">
@endsection

@section('js-append')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.js"></script>
    <script src="/vendor/admin/datepicker/bootstrap-datepicker.js"></script>
    <script src="/vendor/admin/datepicker/locales/bootstrap-datepicker.ru.js"></script>
    <script src="/vendor/admin/bootstrap/js/bootstrap-toggle.js"></script>
    <script>
        CKEDITOR.replace('description',{
            language: 'ru'
        });

        CKEDITOR.replace('short_description',{
            language: 'ru'
        });

        $(document).ready(function() {
            $('#datepicker').datepicker({
                isRTL: false,
                format: 'yyyy-mm-dd',
                language: 'ru'
            });

            $( "#type_id" ).change(function () {
                var type_id = $(this).val(),
                        vote_section = document.getElementById('vote-section'),
                        gallery_section = document.getElementById('gallery-section'),
                        description = document.getElementById('description-section');

                // if type news is vote
                if(type_id == 1)
                {
                    gallery_section.classList.add("hidden");
                    vote_section.classList.remove("hidden");
                    description.classList.remove('hidden');
                }
                // if type news is gallery
                if(type_id == 2)
                {
                    vote_section.classList.add("hidden");
                    gallery_section.classList.remove("hidden");
                    description.classList.add('hidden');
                }

            });

            $("#add_answer_vote").click(function(e){

                e.preventDefault();

                var itemCount = parseInt(this.dataset.itemCount) + 1;


                var clone = $('#vote-container').clone();

                clone.find("#vote_items").attr('name', 'vote[item]['+itemCount+'][option]');
                clone.find("#vote_items").attr('value', '');
                clone.find("#vote_item_id").remove();

                clone.find("#remove-vote").removeClass('hidden');
                document.getElementById('add_answer_vote').setAttribute('data-item-count', itemCount);

                clone.appendTo('#vote_cloned');
            });

            $(document).on('click', '#remove_vote_btn_cloned', function()
            {
                this.parentNode.parentNode.remove();
            });


            var $uploadCrop;

            function readFile(input) {
                if (input.files && input.files[0]) {
                    document.getElementById('crop-container').classList.remove('hidden');
                    var reader = new FileReader(),
                        cropped;

                    reader.onload = function (e) {
                        $('.upload-demo').addClass('ready');
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        }).then(function(){
                            console.log('jQuery bind complete');

                            $uploadCrop.croppie('result', {
                                type: 'canvas',
                                size: 'viewport'
                            }).then(function (resp) {
                                document.getElementById('base64Image').value = resp;
                            });
                        });

                    }

                    reader.readAsDataURL(input.files[0]);
                }
                else {
                    swal("Sorry - you're browser doesn't support the FileReader API");
                }
            }

            var base64IMage = document.getElementById('base64Image');

            $uploadCrop = $('#upload-demo').croppie({
                viewport: {
                    width: 300,
                    height: 200,
                    type: 'square'
                },
                enableExif: true,
                update: function (data) {
                    $uploadCrop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function (resp) {
                        base64IMage.value = resp;
                    });
                }
            });



            $('#upload').on('change', function () { readFile(this); });
            $('.upload-result').on('click', function (ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (resp) {
                    popupResult({
                        src: resp
                    });
                });
            });


        });
    </script>
@endsection


@section('js')
    <script src="/vendor/admin/ckeditor/ckeditor.js"></script>
@endsection

