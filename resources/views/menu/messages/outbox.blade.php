@extends('layouts.messages')

@section('message-page')
<div class="container">
    @if (count(Auth::user()->character->messagesOutbox) === 0)
        <p class="text-center"><i>No new outbox messages.</i></p>
    @endif
    @foreach (Auth::user()->character->messagesOutbox as $message)
        @if($message->isSystemMessage())
            @continue
        @endif
        <div class="row">
            <table class="table table-sm table-dark">
                <thead>
                    <tr>
                        <th colspan="2"><span aria-hidden="true" class="li_user"></span> <a href="/profile/{{ $message->recipient->name }}">{{ $message->recipient->name }}</a> <small>(recipient)</small> {!! $message->trusted ? '<small><font color=green><b><i>verified</i></b></font></small>' : '' !!}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-10">
                            <span>Subject</span>
                        </td>
                        <td>
                            <span class="not-bold text-wrap">{{ $message->subject }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Message</span>
                        </td>
                        <td>
                            <span class="not-bold text-wrap">
                                @if ($message->trusted)
                                    {!! $message->message !!}
                                @else
                                    {{ $message->message }}
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <small><span aria-hidden="true" class="li_paperplane"></span> {{ $message->created_at }}</small>
                            <a class="float-right pl-2" href="/messages/delete/{{ $message->id }}">Delete</a><a class="float-right" href="/messages/compose/{{ $message->recipient->name }}/AD:{{ $message->subject }}">Addendum</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
</div>
@endsection
