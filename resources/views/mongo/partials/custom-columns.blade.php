@if (!empty($object['colors']))
<?php $colors = $object['colors']; ?>
<!--                            <td>
                                Colors: <br />
                                <div style="font-size: 70% !important;">
                                    {!! dump($colors) !!}
                                </div>
                            </td>-->
<td style="min-width: 400px; padding-right: 20px;">
    <div class="group">
        <?php // dump($colors); ?>
        @include('partials.colors', compact('colors'))
    </div>
</td>
@endif