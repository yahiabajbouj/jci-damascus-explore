@extends('layouts.main')

@section('content')
    <div class="container">
        <form class="mx-auto mt-5 w-75" method="POST" action="{{route('register')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{trans('global.fill_name_ar')}}</label>
                <input maxlength="50" name="fill_name_ar" class="form-control">
            </div>

            <div class="form-group">
                <label>{{trans('global.fill_name_en')}}</label>
                <input required name="fill_name_en" maxlength="50" class="form-control">
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    <label>{{trans('global.birth_date')}}</label>
                    <input type="date" name="birth_date" maxlength="50" class="form-control">
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label>{{trans('global.gender')}}</label>
                    <select name="gender" class="form-select">
                        <option value="0">{{trans('global.male')}}</option>
                        <option value="1">{{trans('global.female')}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>{{trans('global.mobile')}}</label>
                <input required name="mobile" maxlength="10" minlength="10" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label>{{trans('global.whatsapp')}}</label>
                <input required name="whatsapp" maxlength="50" class="form-control">
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    <label>{{trans('global.image')}}</label>
                    <input type="file" name="image" maxlength="50" class="form-control">
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label>{{trans('global.id_image')}}</label>
                    <input type="file" name="id_image" maxlength="50" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label>{{trans('global.fav_quote')}}</label>
                <input required name="quote" maxlength="50" class="form-control">
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    <label>{{trans('global.residence')}}</label>
                    <select required name="Residence" class="form-select">
                        <option value="0">Damascus</option>
                        <option value="1">Aleppo</option>
                        <option value="2">Homs</option>
                        <option value="3">Tartus</option>
                        <option value="4">Latakia</option>
                        <option value="5">Suwayda</option>
                        <option value="6">Wadi</option>
                        <option value="7">Ugarit</option>
                        <option value="8">Baniyas</option>
                    </select>
                </div>

                <div class="form-group col-md-6 col-sm-12">
                    <label>{{trans('global.position')}}</label>
                    <select required name="position" class="form-select">
                        <option value="0">Member</option>
                        <option value="1">Board Member</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>{{trans('global.food_allergy')}}</label>
                <input required name="food_allergy" maxlength="50" class="form-control">
            </div>

            <div class="form-group">
                <label>{{trans('global.illnesses')}}</label>
                <input required name="illnesses" maxlength="50" class="form-control">
            </div>

            <div class="form-group">
                <label>{{trans('global.hotel')}}</label>
                <select required name="hotel_id" class="form-select hotel">
                    @foreach($hotels as $hotel)
                        <option value="{{$hotel->id}}" class="hotel-item"
                                data-price="{{$hotel->price}}">{{$hotel->name}} - {{trans('global.cost_for_person')}} {{trans('global.unit')}}
                            : {{$hotel->price}}</option>
                    @endforeach
                </select>
            </div>
            <p class="font-primary">{{trans('global.texts.hotel_notes')}}</p>
            <hr>
            <p>{{trans('global.activities')}}</p>
            @foreach($activities as $index => $activity)
                <div class="form-check">
                    <input class="form-check-input activity-item" name="activity[]" data-price="{{$activity->price}}" type="checkbox" value="{{$activity->id}}" id="{{$activity->id}}">
                    <label class="form-check-label" for="{{$activity->id}}">
                        {{$activity->name}} - {{trans('global.cost_for_person')}}: {{$activity->price}} {{trans('global.unit')}}
                    </label>
                </div>
            @endforeach
            <h3 class="total-price mt-5">{{trans('global.total_cost')}}: </h3>
            <button type="submit" class="btn btn-primary mt-2 w-100">{{trans('global.submit')}}</button>
        </form>
    </div>
@endsection

@push('custom-scripts')

    <script>
        $('.activity-item').click(function () {
            recalculatePrice();
        });

        $('.hotel').change(function () {
            recalculatePrice();
        });

        function recalculatePrice() {
            let total = 0;
            $('.hotel-item').each((index, item) => {
                if (item.selected) {
                    total += parseFloat(item.dataset.price);
                }
            });
            $('.activity-item').each((index, item) => {
                if (item.checked) {
                    total += parseFloat(item.dataset.price);
                }
            });
            $('.total-price').html("{{trans('global.total_cost')}}: " + `<b>${total}</b>` + " {{trans('global.unit')}}")
        }
    </script>
@endpush
