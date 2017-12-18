<div class="row mb-30">
    <div class="col-md-4 col-md-offset-4">

        <div class="card">

            <div class="card-header">
                <h1>Login</h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row form-wrapper">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row form-wrapper">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">

                    <!--                    <div class="col-md-12">-->
                    <!--                        <div class="alert alert-danger">Invalid password</div>-->
                    <!--                    </div>-->

                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<!--Form-->
<div class="row mb-30">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h1>Form </h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row form-wrapper">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row form-wrapper">
                            <div class="col-md-4 ">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Check me out
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadios" value="option1" checked>
                                    Option one
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadios" value="option2">
                                    Option two
                                </label>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Option</label>
                                    <select id="" class="form-control">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row form-wrapper">
                            <div class="col-md-12 form-group">
                                <label for="">Comment</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">

                    <div class="col-md-12">
                        <div class="alert alert-success">Save Success</div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-default">Clear</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!--Advance Search-->
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="search-box">
                    <div class="item width-90">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <div class="item width-10">
                        <button type="button" class="btn btn-advance">Advance</button>
                    </div>
                </div>

                <div class="search-advance">
                    <form action="">
                        <div class="content">
                            <div class="row form-wrapper">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-default btn-close">Close</button>
                                    <button type="button" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Data Table-->
<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h1>Data Table </h1>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="tb-action">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Natasha Guanwardana</td>
                                <td>natasha@gmail.com</td>
                                <td>078 123 2312</td>
                                <td class="tb-action text-right">
                                    <button type="button" class="btn btn-sm btn-warning">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>