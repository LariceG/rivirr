
<style>
.overflow-y{
    overflow-y: auto !important;
    max-height: 476px;
}
</style>
                        <div class="panel-heading ma-0">
                            <div class="goto-back">
                                <a  id="goto_back" href="javascript:void(0)" class="inline-block txt-grey">
                                    <i class="zmdi zmdi-chevron-left"></i>
                                </a>	
                                <span class="inline-block txt-dark">{{$employeeDet->name}}</span>
                                <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="chat-content overflow-y">
                                    <ul class="nicescroll-bar pt-20">
                                    @foreach($datas as $key => $data)
                                    @if(Session::get('admin_id') == $data->receiver_id)
                                        <li class="friend">
                                            <div class="friend-msg-wrap">
                                                <img class="user-img img-circle block pull-left"  src="{{$employeeDet->image}}" alt="user"/>
                                                <div class="msg pull-left">
                                                    <p>{{$data->message}}</p>
                                                    <div class="msg-per-detail text-right">
                                                        <span class="msg-time txt-grey">{{$data->created_at}}</span>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>	
                                        </li>
                                        @else
                                        <li class="self mb-10">
                                            <div class="self-msg-wrap">
                                                <div class="msg block pull-right"> {{$data->message}}
                                                    <div class="msg-per-detail text-right">
                                                        <span class="msg-time txt-grey">{{$data->created_at}}</span>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>	
                                        </li>
                                        @endif
                                        @endforeach
                                        <li>
                                        </li>
                                    </ul>
                                </div>
                                <div class="input-group">
                                    <input type="hidden" name="receiver_id" id="receiver_id" value="{{$employeeDet->id}}"/>
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="url" id="url" value="{{url('/admin/supervisors/sendMessage')}}"/>
                                    <input type="text" id="input_msg_send" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
                                    <div class="input-group-btn emojis">
                                        <div class="dropup">
                                            <button type="button" class="btn  btn-default  dropdown-toggle" data-toggle="dropdown" ><i class="zmdi zmdi-mood"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="javascript:void(0)">Action</a></li>
                                                <li><a href="javascript:void(0)">Another action</a></li>
                                                <li class="divider"></li>
                                                <li><a href="javascript:void(0)">Separated link</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="input-group-btn attachment">
                                        <div class="fileupload btn  btn-default"><i class="zmdi zmdi-attachment-alt"></i>
                                            <input type="file" class="upload">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
               