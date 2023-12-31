@extends('layouts.base')

@section('content')
    <br>
    <br>
    <br>
    <div class="d-flex" style="margin-top:-55px">

        <div style="flex:3;" class="p-4">
            <div class="row d-flex gap-2">
                @foreach ($categories as $category)
                    <div class="card" style="width: 250px">
                        <div class="card-body p-3">
                            <div class="row d-flex">
                                <div style="flex:1">
                                    <img style="width:50px;" src="{{ url('images/' . $category->image) }}" alt="">

                                </div>
                                <div style="flex:3">
                                    <p>{{ $category->name }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            <br>
            <br>

            <div class="d-flex" style="flex-wrap: wrap;gap:5px;justify-content:space-between;">
                @foreach ($menus as $menu)
                    <div class="card mb-4" style="width: 14rem;">
                        <img style="height: 160px" src="{{ url('images/' . $menu->image) }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                card's content.</p>
                            <button type="button" data-img="{{ url('images/' . $menu->image) }}"
                                data-name="{{ $menu->name }}" data-id="{{ $menu->id }}"
                                class="btn btn-primary add-item">Add to card</button>
                        </div>
                    </div>
                @endforeach

            </div>



        </div>


        <div style="flex:2;" class="p-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Invoices</h6>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-outline-primary btn-sm mb-0">View All</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pb-0">
                    <div style="height: 600px;overflow:scroll;" id="summary">
                    </div>



                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Categories</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-mobile-button text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Devices</h6>
                                            <span class="text-xs">250 in stock, <span class="font-weight-bold">346+
                                                    sold</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-tag text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                                            <span class="text-xs">123 closed, <span class="font-weight-bold">15
                                                    open</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-box-2 text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                                            <span class="text-xs">1 is active, <span class="font-weight-bold">40
                                                    closed</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-satisfied text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                                            <span class="text-xs font-weight-bold">+ 430</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
@endsection

@section('scripts')
    <script>
        var orders = [];



        function displayMenu() {

            html = '';
            orders.forEach(element => {
                html += `
                    <div class="card mb-3 w-100">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex p-2" style="justify-content: center;align-items:center;">
                                <img style="border-radius: 10px"
                                    src="${element.img }"
                                    class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">${element.name}</h5>
                                    <p class="card-text"><small class="text-body-secondary">QTY : ${element.qty}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
            });
            $('#summary').html(html);

        }

        $('.add-item').on('click', function(e) {

            check = orders.map(a => a.id);

            if (check.includes($(this).data('id'))) {
                orders[check.indexOf($(this).data('id'))].qty += 1;
            } else {
                orders.push({
                    'id': $(this).data('id'),
                    'name': $(this).data('name'),
                    'img': $(this).data('img'),
                    'qty': 1,
                });
            }

            displayMenu();

        });
    </script>
@endsection
