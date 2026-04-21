@forelse ($menus as $menu)
<div class="card shadow mb-1" id="{{ $menu->id }}">
    <div class="card-header w3-small px-2 py-1">
       <i class="fas fa-arrows-alt-v text-muted" style="cursor: move;"></i> 

       @if($menu->active)
       <i class="fas fa-check-square text-success" style="cursor: move;"></i> 
       @else
       <i class="far fa-square w3-light-gray" style="cursor: move;"></i> 
       @endif 
       <span class="text-muted w3-small">Name : <strong>{{ $menu->name_en ? $menu->name_en : "" }}</strong> </span>
       &nbsp;
            
   
        @if($menu->link)
             
        @else
            <a title="Delete" class="float-right btn btn-light btn-xs ml-1" onclick="return confirm('Do you really want to delete?');"  onclick="return confirm('Do you really want to delete?')"
            href="{{ route('admin.menuDelete', $menu)}}"><i
            class="fas fa-times-circle text-danger"></i></a>
        @endif

        <a class="btn btn-light btn-xs float-right" data-toggle="collapse"
            href="#collapseExample{{$menu->id}}" role="button" aria-expanded="false"
            aria-controls="collapseExample{{$menu->id}}">
            <i class="fas fa-edit text-muted"></i>
        </a>

        <i class="float-right mr-2 w3-tiny text-muted">{{$menu->type ?? ""}}</i>

        @if($menu->link)
          <a target="_blank" href="{{ url($menu->link) }}" class="badge mt-1  badge-primary mr-2 btn float-right">View</a>
          <button class="copyboard btn mt-1 badge badge-primary text-white float-right mr-2" data-id="{{ $menu->id }}"  data-text="{{ $menu->link }}"> Copy url </button>
        @else
        @endif


    </div>
    <div class="collapse" id="collapseExample{{$menu->id}}">
        <div class="card-body bg-light pt-2 pb-0">
            <form action="{{route('admin.menuUpdate',$menu)}}" method="POST">
                @csrf
                <dl class="row">
                    <dt class="col-sm-3 w3-small text-right">Name: <span class="text-danger">*</span></dt>
                    <dd class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" value="{{$menu->name_en}}" name="name_en" required>
                    </dd>

                    <dt class="col-sm-3 w3-small text-right">Slug: <span class="text-danger"></span></dt>
                    <dd class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" value="{{ $menu->slug }}" name="slug" required>
                    </dd>


                    <dt class="col-sm-3 w3-small text-right">Menu Type: <span class="text-danger">*</span></dt>
                    <dd class="col-sm-9">
                        
                        <select name="type" id="type" class="form-control">
                            <option value="">select menu type</option>
                            @foreach (config('parameter.menu_type') as $item)
                                <option value="{{ $item }}" {{ $menu->type == $item  ? 'selected' : ' '}}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </dd>

                    <dt class="col-sm-3 w3-small text-right">Link: </dt>
                    <dd class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" value="{{$menu->link}}"  name="link" placeholder="https://example.com">
                    </dd>

                    <dt class="col-sm-3 w3-small text-right">Active: </dt>
                    <dd class="col-sm-9">
                        <input class="form-check-input ml-0"  name="active" type="checkbox" 
                        @if($menu->active == 1) checked @endif>
                        <button type="submit" class="btn btn-primary btn-xs float-right">Update</button>
                    </dd>
                        
                </dl>
            </form>
        </div>
    </div>
  
</div>
@empty
<div class="text-danger h5 text-center">
    <h3 >No menu Found</h3>
</div>
@endforelse




