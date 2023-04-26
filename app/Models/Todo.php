<?php

namespace App\Models;

use App\Enums\TodoStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Todo extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order',
        'wedding_id',
        'title',
        'status',
        'date',
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'status' => TodoStatuses::class
    ];

    public function setStatus($status)
    {
        $this->update([
            'status' => $status
        ]);
    }

    public static function createTodoListForNewWedding($wedding_id)
    {
        foreach(self::defaultTodoList() as $todo){
            self::create([
                'wedding_id' => $wedding_id,
                'title' => $todo,
                'status' => TodoStatuses::TODO,
            ]);
        }
    }

    public static function defaultTodoList()
    {
        return [
            'Értesítsétek a rokonokat és barátokat.',
            'Tervezzetek eljegyzési partit vagy vacsorát.',
            'Ha külön eljegyzési vagy körgyűrűje lesz a menyasszonynak akkor azt itt az ideje beszerezni!',
            'Rendeljétek meg az esküvői gyűrűket is.',
            'Kezdjetek el gondolkozni az esküvői meghívón. Nézzetek meg minél több mintát, keressetek idézetet.',
            'Egyezzetek meg a költségeken, és azon, hogy ki mit tud magára vállalni.',
            'A hivatalos polgári szertartáshoz egyeztessetek az anyakönyvi hivatallal. Foglaljátok le az időpontot és egyeztessétek milyen jellegű és nagyságrendű rendezvényt szeretnétek.',
            'Ha egyházi szertartást is szeretnétek, szervezzetek meg egy találkozót a pappal/lelkésszel, és vele is beszéljétek meg a részleteket.',
            'Készítsetek egy kezdeti vendéglistát, hogy körülbelül hány főt szeretnétek a szertartásokon, illetve a fogadáson vagy a lakodalmon vendégül látni.',
            'Válasszátok ki a tanúitokat, a koszorúslányokat, a vőfélyt.',
            'Látogassatok el a lehetséges fogadási, lakodalmi helyszínekre.',
            'Beszéljétek meg a menüopciókat, valamint az erre szánt költségeket.',
            'Foglaljátok le a fogadás, a lakodalom helyszínét amilyen hamar csak tudjátok.',
            'Kezdjetek el ötleteket gyűjteni az esküvői-lakodalmi ruháitokra, illetve a kísérőitek (pl. koszorúslányok) ruháira vonatkozóan.',
            'Keressetek esküvői fotóst. Válasszátok ki a legszebb portfólióval rendelkezőt, kérjetek tőle árajánlatot. A legszimpatikusabbat foglaljátok le.',
            'Véglegesítsétek a meghívottak listáját.',
            'Rendeljétek meg az esküvői meghívókat. Külön meghívót rendeljetek azoknak, akiket csak a szertartás(ok)ra hívtok meg, és azoknak akiket a fogadásra is.',
            'Beszéljétek meg a vőféllyel hogyan szeretnétek az esküvő menetét. Szerezzétek be a szükséges hivatalos papírokat. Ügyeljetek arra, hogy a dokumentumaitok érvényesek legyenek.',
            'Válasszatok idézeteket és zenét a szertartás(ok)hoz.',
            'Döntsétek el, szeretnétek-e egy kis minifogadást a szertartás(ok) után, főleg azon vendégek részére, akik az esti lakodalmon nem vesznek részt.',
            'Szervezzétek meg a zenét a fogadásra és lakodalomra.', 
            'Találjátok ki és rendeljétek meg az esküvői tortát.',
            'Válasszátok ki a virágokat: az esküvői csokrot, a vőlegény öltönyére illetve a kísérők ruhájára szánt virágdíszt, a polgári és/vagy egyházi szertartás, a fogadás helyszínének növénydíszeit, az asztalok díszítményeit. Rendeljétek meg a díszeket!',
            'Állapodjatok meg az esküvői ruhákban. Itt az ideje beszerezni őket!',
            'Nézzetek kiegészítőket magatoknak és a kísérőiteknek.',
            'Gondolkodjatok el az esküvői frizuráról és sminkről.',
            'Foglaljátok le az esküvői autókat és minden egyéb, közlekedéshez szükséges dolgot.',
            'Foglaljátok le a nászéjszaka helyszínét és a nászutat: repülőjegyeket, hotelt, stb.',
            'Ellenőrizzétek, hogy az útleveleitek érvényesek-e, és rendezzétek az utazáshoz szükséges oltásokat vagy vízumokat.',
            'Foglaljátok le a fodrászt és a sminkest, készítessetek próbafrizurát és próbasminket.',
            'Menjetek el esküvői próbafotózásra a lefoglalt fotóssal.',
            'Véglegesítsétek az esküvő napjának rendjét.',
            'Erősítsétek meg az összes foglalást.',
            'Rendeljétek meg a helyszín- és asztaldekorációt.',
            'Küldjétek ki a meghívókat.',
            'Szervezzétek meg a távolról érkező vendégek utaztatását és igény szerint a szállását (beszéljétek át velük ki állja a szállás költségeit).',
            'Véglegesítsék az esküvői menüt.',
            'Ha nevet változtattok, tájékoztassátok a bankotokat és a többi intézményt amit szükséges.',
            'Hagyjátok jóvá a fogadás részleteit és az időbeosztást írásban.',
            'Próbáljátok fel az esküvői ruhátokat, és bizonyosodjatok meg róla, hogy kényelmes és jól érzitek magatokat benne. Ha szükséges, varrónővel igazíttassatok rajta.',
            'Készítsétek el az ülésrendet.',
            'Kezdjetek el készülődni a nászutatokra.',
            'Erősítsétek meg a fodrász, a sminkes és a körmös időpontját.',
            'Kérdezzetek rá, hogy minden rendben halad-e a rendeléseitekkel (torta, virágdíszek stb.).',
            'Bizonyosodjatok meg róla, hogy a virágkötő, fotós/videós pontosan ismeri a feladatát.',
            'Szervezzétek meg az asztali dekorációk szállítását a fogadási helyszín(ek)re.',
            'Tervezzetek be egy kis pihenést magatoknak.',
            'Győződjetek meg róla, hogy mindenki tisztában van a vele szemben támasztott elvárásoknak.',
            'A családtagok és a barátok segítségével díszítsétek fel a fogadás helyszínét amennyiben ezt ti csináljátok.',
            'Intézzétek el az esküvői torta szállítását az esküvőre.',
            'Gyűjtsetek össze mindent, amire szükségetek lesz a nagy nap folyamán.',
            'Bizonyosodjatok meg hogy elég időtök van felkészülni.',
            'Indítsátok a napot egy jó reggelivel.',
            'Szállíttassatok el mindent amit esetleg még kell (virágok, hangosítási eszközök, sütemények stb.).',
            'Juttassatok vissza minden kölcsönkért, bérbe vett tárgyat, és vegyétek fel a foglalót.',
            'Gondoljátok át, hogy tudnátok az esküvői csokrot vagy más virágdíszeket megőrizni.',
            'Küldjetek ki köszönőleveleket, és juttassátok el az ajándékaitokat azon személyeknek, akiknek nagyon hálásak vagytok.',
            'Intézzétek el az esküvői ajándékaitok elszállítását.',
            'Gyűjtsétek össze az esküvői fotóitokat és videóitokat.',
            'Tisztíttassátok ki az esküvői ruháitokat.,' 
        ];
    }
}
