@extends('admin.master')
@section('title',"Admin Dashboard | News Show")
@section('body')
    <section class="pt-5">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Details</h3>
            </div>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Post Id</th>
                    <td>{{$news->id}}</td>
                </tr>
                <tr>
                    <th>Post Title</th>
                    <td>{{$news->title}}</td>
                </tr>
                <tr>
                    <th>Post Excerpt</th>
                    <td>{{$news->excerpt}}</td>
                </tr>
                <tr>
                    <th>Post Description</th>
                    <td>{!!html_entity_decode($news->description)!!}</td>
                </tr>
                <tr>
                    <th>Post Excerpt</th>
                    <td>{{$news->tags}}</td>
                </tr>
                <tr>
                    <th>Feature Image</th>
                    <td>
                        <img src="{{ route('imagecache', ['template' => 'pplg', 'filename' => $news->fi()]) }}" alt="post_image">
                    </td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{$news->status}}</td>
                </tr>

            </table>
        </div>
    </section>
@endsection

