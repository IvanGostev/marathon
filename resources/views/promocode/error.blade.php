<div class="mb-3">
    <label class="form-label">
        <h4>Стоимость: {{$subscribe['price']}}руб</h4>
        <p>Нет скрытых платежей и авто продления</p>
    </label>
</div>
<div class="mb-3">
    <label class="form-label">Промокод <span style="font-weight: 600" class="text-danger">Не активирован</span></label>
    <input style="border-radius: 0.5rem;" id="promocode" name="promocode" type="text"
           class="form-control border-danger" >
</div>
<a href="#"  onclick="checkPromocode()" class="btn btn-primary">Применить промокод</a>
<input type="text" class="hidden" name="subscribe" value="{{$subscribe['name']}}">
