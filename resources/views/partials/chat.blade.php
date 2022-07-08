@if (!(isset($navbar)))
    @if ($chat->count())
        <div class="fabs">
            <div class="chat">
                <div class="chat_header mb-0">
                    <div class="chat_option">
                        <div class="header_img">
                            <img src="{{ asset('assets/img/picture/icon_chat.png') }}" />
                        </div>
                        <span id="chat_head">ChatBot</span> <br> 
                        <span class="online">(Online)</span>
                        <span id="chat_fullscreen_loader" class="chat_fullscreen_loader"><i class="fullscreen zmdi zmdi-window-maximize"></i></span>
                    </div>
                </div>
                <div id="chat_fullscreen" class="chat_conversion chat_converse">
                    <span class="chat_msg_item chat_msg_item_admin mb-0">
                        <div class="chat_avatar">
                            <img src="{{ asset('assets/img/picture/icon_chat.png') }}" />
                        </div>Hey! Ada pertanyaan?
                    </span>
                    <span class="chat_msg_item chat_msg_item_admin mb-0">
                        Silahkan pilih topik pertanyaan dibawah ini.
                    </span>
                    <span class="chat_msg_item ">
                        <ul class="tags my-0">
                            @foreach ($chat as $cht)
                                <li onclick="showAnswer({{ $cht->id }})">{!! $cht->pertanyaan !!}</li>
                            @endforeach
                        </ul>
                    </span>
                    <div id="answers"></div>
                </div>
            </div>
            <a id="prime" class="fab"><i class="prime zmdi zmdi-comment-outline"></i></a>
        </div>
    @else
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    @endif

    @push('after-script')
        <script>
            function showAnswer(id){
                $.ajax({
                    url: `/answer-chat/${id}`,
                    type: 'get',
                    success: function(data){
                        $('#answers').append(`<span class="chat_msg_item chat_msg_item_user">${data.pertanyaan}</span>`);

                        loadTyping();

                        window.setTimeout(() => {
                            $('#load-typing').remove();
                            $('#answers').append(`<span class="chat_msg_item chat_msg_item_admin mb-0">
                                                    <div class="chat_avatar">
                                                        <img src="{{ asset('assets/img/picture/icon_chat.png') }}" />
                                                    </div>${data.jawaban}
                                                </span>`);
                            $('#answers').append(`<span class="chat_msg_item ">
                                                    <ul class="tags my-0">
                                                        <li onclick="backOption()">Tanyakan Lagi</li>
                                                    </ul>
                                                </span>`);
                        }, 1500);
                    }
                });
            }

            function backOption(){
                loadTyping();

                window.setTimeout(() => {
                    $('#load-typing').remove();
                    $('#answers').append(`<span class="chat_msg_item chat_msg_item_admin mb-0">
                                        <div class="chat_avatar">
                                            <img src="{{ asset('assets/img/picture/icon_chat.png') }}" />
                                        </div>Silahkan pilih topik pertanyaan dibawah ini
                                    </span>`);

                    let list = `<span class="chat_msg_item">
                                    <ul class="tags my-0">`;
                                        @foreach ($chat as $cht)
                                            list += `<li onclick="showAnswer({{ $cht->id  }})">{{ $cht->pertanyaan }}</li>`;
                                        @endforeach
                    list += `</ul>
                            </span>`;
                    
                    $('#answers').append(list);
                }, 1500);
            }

            function loadTyping(){
                $('#answers').append(`<div id="load-typing">
                                            <span class="chat_msg_item mb-0">
                                                <div class="chat_avatar">
                                                    <img src="{{ asset('assets/img/picture/typing.gif') }}" />
                                                </div>
                                            </span>
                                        </div>`);
            }
        </script>
    @endpush
@endif