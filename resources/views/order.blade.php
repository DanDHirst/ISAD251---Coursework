@extends('layout.app')
@section('header')
    <main class="page">
        <div style="height: 100px"></div>
        <section class="clean-block clean-pricing dark">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form>
                        <ul></ul>
                    </form>
                </div>
                <div class="col-md-4">
                    <form><small class="form-text text-muted">Enter Table Number</small><input class="form-control" type="text"><small class="form-text text-muted">Enter your Email</small><input class="form-control" type="text"><small class="form-text text-muted">Enter any comments you have about the order</small>
                        <input
                            class="form-control" type="text"><button class="btn btn-primary" type="submit">Sumbit order</button></form>
                </div>
            </div>
        </section>
    </main>
    @section('footer')
