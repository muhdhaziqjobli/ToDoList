<div>
    <h1>Hello World!</h1>
    <div style="text-align: center">
        <button wire:click="increment">+</button>
        <button wire:click="decrement">-</button>
        <h1>{{ $count }}</h1>
    </div>
    <div>
        <h2>Addition</h2>
        <div>
            <input type="number" id="x"> + <input type="number" id="y"> = {{ $answer }}
        </div>
        <div>
            <button>Calculate</button>
        </div>
    </div>
</div>