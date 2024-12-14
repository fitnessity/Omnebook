<form action="{{route('business.class.update')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$class->id}}">
    <input type="hidden" name="cid" value="{{$class->cid}}">
    <input type="hidden" name="serviceid" value="{{$class->serviceid}}">
    <input type="hidden" name="serviceType" value="{{$class->BusinessServices->service_type}}">
    <div class="mb-3">
        <label>Class Name</label>
        <input type="text" class="form-control" id="category_title" name="category_title" required="" value="{{$class->category_title}}">
        @error('category_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label>Class Description</label>
        <textarea name="desc" id="desc1" style="display: none;">{{$class->desc}}</textarea>
        {{-- <textarea name="desc" id="desc1">{{$class->desc}}</textarea> --}}

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-red">Update</button>
    </div>
</form>

<script>
    CKEDITOR.replace('desc1', {
        height: 200,
        extraPlugins: 'colorbutton,font,editorplaceholder,justify,widget'
    }); 
</script>
