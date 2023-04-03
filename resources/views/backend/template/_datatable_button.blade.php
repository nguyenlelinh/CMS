@isset($datatable_btn)
<div class="group-button">
    @foreach ($datatable_btn as $key => $btn)
        <button <?=(isset($slug) && isset($id))?strtr(implode(' ', array_map(function ($v, $k) { return sprintf("%s='%s'", $k, $v); }, $btn['btn'], array_keys($btn['btn']))),['<slug>'=>$slug,'<id>'=>$id]):null?>>{!!$btn['icon']!!}</button>
    @endforeach
</div>
@endif
