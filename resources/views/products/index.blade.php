@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        {{ __('Data') }}
                        <a href="{{ route('products.import') }}" class="btn  btn-success ml-auto">Import</a>
                        <button type="button" class="btn btn-danger btn-sm ml-3" data-toggle="modal"
                                data-target="#delete"
                                title="حذف">
                            Delete All
                        </button>

                    </div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-{{ session('alert-type') }}" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Salary</th>
                                <th>Number Of Hours</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->salary }}</td>
                                <td>{{ $product->hours }}</td>


                                    @if($product->hours == 208)
                                        <td class="text-white" style="background-color: #008000">{{ $product->salary }}</td>
                                    @elseif($product->hours > 208)
                                        <td class="text-white" style="background-color: #ffb01f">
                                            @php
                                                $over= $product->hours - 208;
                                                 echo  number_format((($product->salary )/ 208) * ($product->hours - $over )
                                                  + ( ((($product->salary )/ 208) * ($over )) * 2),2);
                                            @endphp

                                        </td>
                                    @else
                                        <td class="text-white" style="background-color: #FF0000">{{ number_format($product->total,2) }}</td>
                                    @endif

                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No products found</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">{{ $products->links() }}</td>
                            </tr>
                            </tfoot>
                        </table>


                            <!-- delete_modal-->
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title"></h6>

                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 style="color: red; font-weight: bold" class="mb-3">Are Sure Delete All Data</h5>
                                            <form action="{{ route('products.delete') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">الغاء</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">تاكيد</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
