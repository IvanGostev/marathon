<div class="mb-3">
    <label class="form-label">
        <h4>Стоимость: {{$subscribe['price']}}руб - <span
                class="text-success">{{$subscribe['price'] * ($promocode->discount / 100)}}</span>руб = <span
                style="font-weight: 600">{{$subscribe['price'] * ((100 - $promocode->discount ) / 100)}}</span>руб</h4>
        <p>Нет скрытых платежей и авто продления</p>
    </label>
</div>
<div class="mb-3">
    <label class="form-label">Промокод <span style="font-weight: 600" class="text-success">Активирован</span></label>
    <input style="border-radius: 0.5rem;" disabled name="promocode" value="{{$promocode->name}}" type="text"
           class="form-control border-success text-success">
</div>
<input type="text" class="hidden" name="promocode" value="{{$promocode->name}}">
<input type="text" class="hidden" name="subscribe" value="{{$subscribe['name']}}">
