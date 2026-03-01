<div class="row">

<div class="col-12 mb-4">

    <div class="card shadow mb-4">
        <div class="card-header">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create category</a>
        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 70%">Title</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        {!! \App\Helpers\Category\Category::getMenu('incs.admin.category-tpl') !!}

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>
