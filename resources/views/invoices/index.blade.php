@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">قائمة الفواتير</h1>

    @can('invoices.create')
        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">إضافة فاتورة</a>
    @endcan

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>رقم الفاتورة</th>
                <th>التاريخ</th>
                <th>المبلغ</th>
                <th>الوكالة</th>
                <th>الخيارات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->number }}</td>
                    <td>{{ $invoice->date }}</td>
                    <td>{{ $invoice->amount }}</td>
                    <td>{{ $invoice->agency->name ?? '-' }}</td>
                    <td>
                        @can('invoices.edit')
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        @endcan

                        @can('invoices.delete')
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">لا توجد فواتير</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $invoices->links() }}
</div>
@endsection
