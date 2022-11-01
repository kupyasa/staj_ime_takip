<x-app-layout title='İME Başvuru Kabul Formunu İndir'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('İME Başvuru Kabul Formunu İndir') }} </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            @if (session()->get('bilgi'))
                <div class="text-center">
                    <h4>İşletmede Mesleki Eğitim başvurunuz alınmıştır. Aşağıdaki butona tıklayarak İşletmede Mesleki
                        Eğitim başvuru kabul formunu
                        indirebilirsiniz.</h4>
                </div>
                <form action="{{ route('ogrenci.imebasvuruformunuindirpost') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @foreach (session()->get('bilgi') as $key => $value)
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="{{ $key }}" name="{{ $key }}"
                                value="{{ $value ? $value : null }}">
                        </div>
                    @endforeach
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">İndir</button>
                    </div>
                </form>
            @else
                <div class="text-center">
                    <h4>Tekrardan başvuru yapmanız gerekmektedir.</h4>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
