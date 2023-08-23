@include('I-layouts.partials.navbar')
@include('I-layouts.partials.head')


<div class="bbbbootstrap">
<div class="container">
    <form action="{{route('search')}}" method="GET">

            <span role="status" aria-live="polite" class="ui-helper-hidden-accessible">

            </span>
        <input type="text" id="Form_Search" name="q" value="" placeholder="Search for your best result in our community" role="searchbox" class="InputBox " autocomplete="on" required>
        <input type="submit" id="Form_Go" class="Button" value="GO" >


    </form>


</div>
</div>

@include('I-layouts.partials.gallery')

@include('I-layouts.partials.lib')
