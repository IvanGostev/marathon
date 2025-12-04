<form class="modal-content" action="{{route('subscribe.pay')}}" method="post">
    @csrf
    <div class="modal-header">
        <h1 class="modal-title fs-5" >Оплата подписки</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">
                <h4>Стоимость: {{$subscribe['price']}}руб</h4>
                <p>Нет скрытых платежей и авто продления</p>
            </label>
        </div>
        <div class="mb-3">
            <label class="form-label">Промокод</label>
            <input style="border-radius: 0.5rem;" id="promocode" name="promocode" type="text"
                    class="form-control" >
        </div>
        <span href="#"  onclick="checkPromocode()" class="btn btn-primary">Применить промокод</span>
        <input type="text" class="hidden" name="subscribe" value="{{$subscribe['name']}}">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Оплатить</button>
    </div>
</form>
<script>
    promocode = $('#promocode')
    $(document).on('change', '#promocode', function() {
        promocode = $(this).val();
    });
    function checkPromocode() {
        $.ajax({
            url: '{{route('promocode.check')}}',
            type: 'GET',
            data: {
                promocode: promocode,
                subscribe: $('[name="subscribe"]').val()
            },
            success: function (response) {
                $('.modal-body').html(response)
            },
            error: function (xhr, status, error) {
                console.log('Error ' + error)
            }
        });
    }

</script>
