@forelse($requests as $req)
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <img src="{{ $req->user->img ? asset('storage/' . $req->user->img) : asset('img/ava.jpeg') }}"
                    class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                <span>{{ $req->user->name }}</span>
            </div>
        </td>
        <td>
            <span class="badge {{ $req->type === 'coach' ? 'bg-success' : 'bg-primary' }}">
                {{ $req->type === 'coach' ? 'Коуч' : 'Напарник' }}
            </span>
        </td>
        <td>
            <div class="text-wrap" style="max-width: 300px;">
                {{ $req->message }}
            </div>
        </td>
        <td>
            @if($req->file_paths && count($req->file_paths) > 0)
                <div class="d-flex flex-wrap gap-1">
                    @foreach($req->file_paths as $path)
                        @php $extension = pathinfo($path, PATHINFO_EXTENSION); @endphp
                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <a href="{{ asset('storage/' . $path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $path) }}" class="rounded border" width="40" height="40"
                                    style="object-fit: cover;">
                            </a>
                        @else
                            <a href="{{ asset('storage/' . $path) }}" target="_blank" class="btn btn-sm btn-outline-secondary p-1">
                                <i class="fa fa-file-video-o"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            @else
                <span class="text-muted small">Нет файлов</span>
            @endif
        </td>
        <td class="small">{{ $req->created_at->format('d.m.Y H:i') }}</td>
        <td>
            @if($req->user_id !== auth()->id())
                @if(($req->type === 'partner' && auth()->user()->is_assistant === 'active') || ($req->type === 'coach' && auth()->user()->is_coach === 'active'))
                    <form action="{{ route('coach.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $req->user_id }}">
                        <input type="hidden" name="request_id" value="{{ $req->id }}">
                        <input type="hidden" name="type" value="{{ $req->type }}">
                        <button type="submit" class="btn btn-dark btn-sm">Помочь</button>
                    </form>
                @endif
            @else
                <span class="text-muted small">Ваш запрос</span>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center py-4 text-muted">Запросов пока нет</td>
    </tr>
@endforelse