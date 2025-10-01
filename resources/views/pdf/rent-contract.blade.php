<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عقد الإيجار</title>
    <style>
        body {
            font-family: serif;
            font-size: 13.3px;
            padding-top: 5px;
            direction: rtl;
            background-color: #FFFFFF;
        }

        .container {
            max-width: 900px; /* Reduce width slightly to avoid shifting */
            margin: 0 auto; /* Center the content */
            display: flex;
            justify-content: space-between;
            padding: 20px; /* Prevent content from touching the edges */
        }

        .column {
            width: 48%; /* Ensure columns do not overflow */
            text-align: center;
        }

        .arabic {
            direction: rtl;
            float: right;
        }

        .english {
            float: left;
            direction: ltr;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="column english">
        <h2>Lease Agreement</h2>
        <div class="en-first">
            <p>On the {{$data->created_at->format('Y-m-d')}} AD, an agreement was made between:</p>
            <p>1- Eslah Society Registered With The Ministry of Labor and Social Development with the Facility Number
                <b>73300101</b> Represented By shaikh - Dr. Abdullatif Ahmed Alshaikh in his capacity as chairman of
                board directors and authorized to sign on the decision of the Board of Directors and carrying ID No. <b>590033557</b>
                Bahraini Nationality and Address / Building 484, Road 715, Block 207, Muharraq - Kingdom of Bahrain PO
                Box <b>2282</b> (Landlord).</p>

            <p>2. {{$data->User->name}}, carrying ID No. {{$data->User->cpr}}, Address Flat {{$data->User->flat}},
                Building {{$data->User->building}}, Road {{$data->User->road}}, Block {{$data->User->block}},
                {{$data->User->city}} - Kingdom of Bahrain. And is referred to hereinafter as (tenant). The parties
                acknowledge that they are in full legal capacity to conclude a contract and agreed on the following
                terms and conditions.</p>

            @php
                $apartment = optional($data->apartments->first());
                $typeLabelEn = $apartment->is_type_house ? 'apartment' : ($apartment->is_type_store ? 'shop' : 'land');
            @endphp

            <h2>Preamble</h2>
            <p>
                The Landlord owned a {{ $typeLabelEn }}
                @php $index = 0; @endphp

                @foreach($data->property_details as $detail)
                    , {{$detail['flat']}}
                @endforeach

                @foreach($data->property_details as $detail)
                    @if($index == 0)
                        , Building {{$detail['name']}}, Road {{$detail['road']}}, Block {{$detail['block']}}, {{$detail['place']}} - Kingdom of Bahrain.
                    @endif
                    @php $index++; @endphp
                @endforeach
                The Landlord offers to the tenant the property and the tenant accepts to lease it with
                the specified rent value subject to the following terms and conditions. This preamble is an integral
                part of the contract.
            </p>
        </div>
        <div class="en-second">
            <h3>Article One: Definitions and General Provisions</h3>
            <ul>
                @if(count($data['property_details']) > 0)
                    <li><p><b>Building:</b>
                            @foreach($data['property_details'] as $index => $detail)
                                Building {{$detail['name']}}, Road {{$detail['road']}}, Block {{$detail['block']}}
                                , {{$detail['place']}} - Kingdom of Bahrain
                                @if(!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </p></li>

                    @php
                        $apartment = optional($data->apartments->first());
                        $typeLabelEn = $apartment->is_type_house ? 'apartment' : ($apartment->is_type_store ? 'shop' : 'land');
                        $purposeEn   = $apartment->is_type_store ? 'commercial' : 'residential';
                    @endphp

                    <li><b>Leased Property:</b>
                        @if(count($data['property_details']) > 1)
                            The following {{ $typeLabelEn }}s:
                            {{ implode(', ', array_column($data['property_details'], 'flat')) }}, will be used for {{ $purposeEn }} purposes.
                        @else
                            A {{ $typeLabelEn }} {{$data['property_details'][$index]['flat']}}, will be used for {{ $purposeEn }} purposes.
                        @endif
                    </li>
                @endif

                <br>
                <li><b>Landlord:</b> The owner of the leased property or whoever acts on his behalf or whoever is
                    legally authorized to conclude a lease agreement.
                </li>
                <br>
                <li><b>Tenant:</b> The beneficiary of a leased property or his assignee in accordance with the
                    provisions of this law.
                </li>
                <br>
                <li><b>The Explicit Termination Provision:</b> A provision that gives the Landlord the right to evict
                    the tenant if they fail to pay the rent for one month.
                </li>
                <br>
                <li><b>Vacation of the Leased Property:</b> Cases where the tenant must vacate the leased property by
                    law or as stated in this agreement.
                </li>
                <br>
                <li><b>Necessary Maintenance:</b> Urgent repairs needed to protect the leased property from damage and
                    ensure it remains suitable for its intended purpose, such as electricity and water connectivity.
                </li>
                <br>
                <li><b>Leasing Maintenance:</b> Necessary minor repairs for the tenant's use of the leased property in
                    accordance with its intended purpose.
                </li>
            </ul>

            <br>
            <br>
            <br>
            <br>
            <h3>Article Two – Term of the Agreement</h3>
            <p>The duration of this Lease Agreement shall be from {{$data->start_at->format('Y-m-d')}} to and
                including {{$data->end_at->format('Y-m-d')}}. This agreement
                expires on the date of its expiration and shall only be renewed upon written consent signed by the two
                parties.</p>


            <h3>Article Three – The Intended Purpose</h3>
            @php
                $apartment = optional($data->apartments->first());
                $typeLabelEn = $apartment->is_type_house ? 'apartment' : ($apartment->is_type_store ? 'shop' : 'land');
                $purposeEn   = $apartment->is_type_store ? 'commercial' : 'residential';
            @endphp

            <p>The leased property is a {{ $purposeEn }} {{ $typeLabelEn }} for {{ $purposeEn }} purpose only.</p>


            <h3>Article Four – Rent</h3>
            <p>The tenant shall pay to the landlord, as a monthly rental,

                The sum of BD {{$data->cost}}
                ({{ ucfirst(Rmunate\Utilities\SpellNumber::integer($data->cost)->toLetters()) }} Bahraini Dinars).


                The rent will be deemed to be due on the first day of each and every Gregorian
                month of the term.</p>


            <h3>Article Five - Landlord's Obligations</h3>
            <ul>
                <li> A landlord shall handover the leased property and all its annexes to the tenant in a state that
                    is intended to benefit therefrom in accordance with what has been agreed upon or the nature of the
                    property.
                </li>
                <li> A landlord shall carry out the necessary maintenance of the leased property.</li>
                <li> A landlord shall not commit any act likely to prevent a tenant from benefiting from one of his
                    rights or any privilege by virtue of this agreement or in accordance with what the leased property
                    is intended for.
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>Article Six - Tenant’s Obligations</h3>
            <ul>
                <li> A tenant shall pay the rent on the due date specified in the agreement to the landlord as
                    stipulated in Article Four above. He shall have a receipt acknowledgement voucher signed by the
                    landlord after he deposited the amount in the landlord’s bank account.
                </li>
                <li> A tenant shall maintain the leased property in accordance with the usual care of an ordinary
                    person, and shall not make any alterations to it without a written permission from the landlord.
                </li>
                <li> The tenant shall comply with public order and not disturb other resident by immoral or indecent
                    conduct while he is occupying the leased property.
                </li>
                <li> The Landlord shall have the right, subject to the tenant’s consent and prior reasonable notice to
                    him, to enter the leased property in order to inspect the premises, and make necessary repair and
                    maintenance.
                </li>
                <li> A tenant shall pay the costs of water, electricity, telephone services, joint services and any
                    other charges related to the leased property.
                </li>
                <li> A tenant shall utilize the leased property as per the intended purpose.</li>
                <li> A tenant shall carry out rental maintenance on the leased property.</li>
                <li> The lessee should give one months prior written notice termination of the lease to the lessor if
                    he decided to vacate the building.
                </li>
            </ul>
            <br>

            <h3>Article Seven – The Explicit Termination Provision</h3>
            <ul>
                <li>The landlord has the right to evict the tenant from the property if the rent is unpaid when due and
                    Tenant fails to pay within one month based on eviction order passed by the lease dispute chamber and
                    thus this agreement is automatically terminated and the tenant have no right in it.
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>Article Eight - Termination of the Agreement</h3>
            <ul>
                <li>The expiration of the agreement is upon the expiration date of its term and the tenant is obliged to
                    deliver the property to the landlord on the expiration date thereof and shall be renewed by a new
                    agreement.
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>Article Nine - Vacating the Leased Property</h3>
            <ul>
                <li>The landlord may request the tenant to vacate the leased property, and the agreement shall be deemed
                    automatically terminated in any of the following events:
                </li>
                <li> If the tenant refuses to pay the rent on the due date as specified in this agreement.</li>
                <li> If a tenant assigns the lease or subleases all or part of the leased property, or vacates it for
                    a party other than the owner without a written consent of the owner.
                </li>
                <li> If a tenant uses the leased property for accommodating a number of people in excess of the
                    norm.
                </li>
                <li> If a tenant uses the leased property or allows it to be used in a manner not consistent with the
                    terms of the agreement or the purpose for which it was built, or in violation of public order or
                    decency, or in a manner that harms the financial interests of the landlord.
                </li>
                <li> If the leased property becomes dilapidated and is feared to pose a threat to the safety of its
                    occupants, or if a final administrative decision is issued by the competent municipality to demolish
                    it
                </li>
                <li> If a tenant uses the leased property or allows it to be used for a purpose other than the one for
                    which it was leased in accordance with its nature or if he makes alterations to it that may damage
                    its structural safety.
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <h3>Article Ten – Governing Law and Jurisdiction</h3>
            <ul>
                <li> This contract is subject to the terms and provisions of the prevailing laws in the Kingdom of
                    Bahrain, as well as it is subject to the jurisdiction of Courts of Bahrain.
                </li>
                <li> The parties shall exert every effort to amicably resolve any dispute of any kind whatsoever
                    arising out of the interpretation of this agreement. The parties hereto shall submit the dispute to
                    the court if they fail to amicably settle it.
                </li>
                <br>
                <br>
                <br>
                <br>
                <li>This agreement is executed in two counterpart copies and each party has a copy to work
                    accordingly.
                </li>
                <li>In case of any contradiction or discrepancies between the Arabic text and its translation into
                    English language, the Arabic text of this contract shall prevail.
                </li>
            </ul>
            <br>
            <h3>The First Party (the Landlord)</h3>
            <h3>Name: Abdullatif Ahmed Alshaikh</h3>
            <ul>
                <li>Signature......................</li>
            </ul>

            <h3>The Second Party (the Tenant)</h3>
            <h3>Name: {{$data->User->name}}</h3>
            <ul>
                <li>Signature......................</li>
            </ul>

        </div>
    </div>
    <div class="column arabic">
        <h2>عقد إيجار</h2>
        <div class="ar-first">
            <p>انه في {{$data->created_at->format('Y-m-d')}}، تم التعاقد بين كلًا من:</p>
            <p>1- السادة/ جمعية الإصلاح والمسجلة لدى وزارة العمل والتنمية الاجتماعية تحت المنشأة رقم <b>73300101</b>
                ويمثلها الشيخ الدكتور عبد اللطيف أحمد الشيخ بصفته رئيس مجلس الإدارة والمخول بالتوقيع بناءً على قرار مجلس
                الإدارة، وحامل بطاقة الهوية رقم <b>590033557</b> بحريني الجنسية وعنوانها/ مبنى 484، طريق 715، مجمع 207،
                مملكة البحرين ص.ب <b>2282</b> (ويشار إليها لاحقًا بالمؤجر).</p>
            <br>

            <p>2- السيد/ة {{$data->User->name}} ، تحمل بطاقة هوية رقم {{$data->User->cpr}}، وعنوانه
                شقة {{$data->User->flat}}، مبنى رقم {{$data->User->building}}، طريق {{$data->User->road}}،
                مجمع {{$data->User->block}}، {{$data->User->city}} - مملكة البحرين، ويشار إليه لاحقاً بـ(المستأجر) وبعد
                أن اقر الطرفان بكامل
                أهليتهما للتعاقد و إبرام التصرفات القانونية، اتفق الطرفان على الآتي: -</p>
            <br>
            <br>
            <h2>تمهيد</h2>

            <p>
                يمتلك المؤجر
                {{ $data->apartments->first()->is_type_house ? 'شقة' : ($data->apartments->first()->is_type_store ? 'محل' : 'قطعة أرض') }}
                @php $index = 0; @endphp

                @foreach($data->property_details as $detail)
                    , {{$detail['flat']}}
                @endforeach

                @foreach($data->property_details as $detail)
                    @if($index == 0)
                        ، مبنى {{$detail['name']}} ، طريق {{$detail['road']}}، مجمع {{$detail['block']}}, {{$detail['place']}}
                    @endif
                    @php $index++; @endphp
                @endforeach
                - مملكة البحرين. ورغبة منه في تأجيرها، فقد تلاقت إرادة المؤجر مع إرادة المستأجر للانتفاع مقابل مبلغ محدد
                ووفقاً للبنود التالية: يعتبر هذا التمهيد جزءاً لا يتجزأ من العقد.
            </p>


        </div>
        <br>
        <br>

        <div class="ar-second">
            <br>
            <br>
            <h3>البند الأول: التعاريف والأحكام العامة</h3>
            <ul>
                @if(count($data['property_details']) > 0)
                    <p><b>البناية:</b>
                        @foreach($data['property_details'] as $index => $detail)
                            مبنى {{$detail['name']}}, طريق {{$detail['road']}}, مجمع {{$detail['block']}}
                            , {{$detail['place']}} - مملكة البحرين
                            @if(!$loop->last)
                                ،
                            @endif
                        @endforeach
                    </p>
                    <br>

                    <li><b>العين المؤجرة:</b>
                        @php
                            $apartment = optional($data->apartments->first());
                            $typeLabel = $apartment->is_type_house ? 'شقة' : ($apartment->is_type_store ? 'محل' : 'قطعة أرض');
                            $purpose   = $apartment->is_type_store ? 'تجاري' : 'سكني';
                        @endphp

                        @if(count($data['property_details']) > 1)
                            {{ $typeLabel }}{{ count($data['property_details']) > 1 ? ' التالية:' : '' }}
                            {{ implode(', ', array_column($data['property_details'], 'flat')) }}، تستخدم لغرض {{ $purpose }}.
                        @else
                            {{ $typeLabel }} {{$data['property_details'][$index]['flat']}}, تستخدم لغرض {{ $purpose }}.
                        @endif
                    </li>


                @endif

                <br>
                <br>
                <li><b>المؤجر:</b> مالك العين المؤجرة/ أو من ينوب عنه، أو من يخول قانوناً بإبرام عقد الإيجار.</li>
                <br>
                <br>
                <li><b>المستأجر:</b> المنتفع بالعين المؤجرة، أو من تؤول إليه حقوقه وفقاً لأحكام هذا القانون.</li>
                <br>
                <li><b>الشرط الفاسخ الصريح:</b> وهو شرط بموجبه يحق للمؤجر طرد المستأجر في حال تخلفه عن دفع الأجرة لشهر
                    واحد.
                </li>
                <br>
                <br>
                <li><b>إخلاء العين المؤجرة:</b> الحالات التي يستوجب العقد والقانون فيها على المستأجر إخلاء العين
                    المستأجرة وينفسخ العقد فيها من تلقاء نفسه ويعتبر المستأجر غاصبًا للعين المؤجرة.
                </li>
                <br>
                <li><b>الصيانة الضرورية:</b> الإصلاحات المستعجلة اللازمة لحفظ العين المؤجرة من الهلاك وبقائها صالحة
                    للانتفاع بها وفقًا للغرض المعدة له مثل توصيل التيار الكهربائي والمياه.
                </li>
                <br>
                <br>
                <li><b>الصيانة التأجيرية:</b> الإصلاحات البسيطة اللازمة لانتفاع المستأجر بالعين المؤجرة وفقًا للغرض
                    المعد له.
                </li>
            </ul>


            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>البند الثاني: مدة العقد</h3>
            <p> مدة العقد تبدأ من تاريخ {{$data->start_at->format('Y-m-d')}} م وتنتهي
                بتاريخ {{$data->end_at->format('Y-m-d')}} وينتهي العقد بانتهاء مدته، ولا
                يتجدد إلا باتفاق صريح ومكتوب وموقع عليه من كلا الطرفين.</p>
            <br>
            <h3>البند الثالث: الغرض</h3>
            @php
                $apartment = optional($data->apartments->first());
                $typeLabel = $apartment->is_type_house ? 'شقة' : ($apartment->is_type_store ? 'محل' : 'قطعة أرض');
                $purpose   = $apartment->is_type_store ? 'تجاري' : 'سكني';
            @endphp

            <p>العين المؤجرة معدة ك{{ $typeLabel }} تستخدم لغرض {{ $purpose }}.</p>


            <h3>البند الرابع: الأجرة</h3>

            <p>يلتزم المستأجر بدفع أجرة شهرية مبلغ وقدره {{$data->cost}} د.ب
                ({{\Alkoumi\LaravelArabicNumbers\Numbers::TafqeetMoney($data->cost, 'BHD')}}) ، وتدفع مقدم كل شهر
                ميلادي.</p>

            <br>

            <h3>البند الخامس: التزامات المؤجر</h3>
            <ul>
                <li> يلتزم المؤجر بتسليم المستأجر العين المؤجرة وملحقاتها فور انعقاد العقد في حالة تصلح معها لاستيفاء
                    المنفعة التي أعدت لها وفقا لطبيعة العين المؤجرة.
                </li>
                <br>
                <li> يلتزم المؤجر بإجراء الصيانة الضرورية للعين المؤجرة.</li>
                <br>
                <li> يلتزم المؤجر بالامتناع عن كل ما من شأنه أن يحول دون انتفاع المستأجر بالعين المؤجرة.</li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>البند السادس: التزامات المستأجر</h3>
            <ul>
                <li> يلتزم المستأجر بسداد الأجرة في الموعد المحدد لها وفقا للبند الرابع أعلاه ويستلم بموجب ذلك إيصالا
                    موقعا من المؤجر وذلك بعد إيداع مبلغ الشيك بحساب المؤجر.
                </li>
                <br>
                <br>
                <br>
                <li> يلتزم المستأجر بالمحافظة على العين المؤجرة وفقاً لعناية الشخص المعتاد، ولا يجوز له إحداث أي تغيير
                    بها دون إذن كتابي من المؤجر.
                </li>
                <br>
                <li> يلتزم المستأجر بالآداب العامة وعدم إزعاج باقي ساكني العين المؤجرة أثناء مدة إقامته.</li>
                <br>
                <li> للمؤجر الحق بناءً على موافقة المستأجر بعد إخطاره بذلك الدخول للعين المؤجرة متى ما دعت الحاجة
                    وإجراء
                    التصليحات اللازمة.
                </li>
                <br>
                <li> يلتزم المستأجر بسداد فواتير الكهرباء والماء والهاتف وأي رسوم وخدمات أخرى.</li>
                <br>
                <li> يلتزم المستأجر باستخدام العين المؤجرة ووفقاً للغرض المعدة له.</li>
                <br>
                <li> يلتزم المستأجر بإجراء الصيانة الإيجارية للعين المؤجرة.</li>
                <br>
                <li> يلتزم المستأجر بإرسال إشعار مكتوب للمؤجر قبل شهر واحد اذا قرر إخلاء العين المؤجرة وسداد الأجرة
                    حتى
                    نهاية مدة الإشعار.
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>البند السابع: الشرط الفاسخ الصريح</h3>
            <br>
            <ul>
                <li>يحق للمؤجر طرد المستأجر من العين المؤجرة في حال تخلفه عن سداد الأجرة لشهر واحد وذلك عن طريق رفع دعوى
                    لدى لجنة المنازعات الإيجارية.و يعتبر هذا العقد مفسوخاً من تلقاء نفسه، وتعتبر يد المستأجر غاصبة للعين
                    المؤجرة، ولا حق له فيها.
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>البند الثامن: انتهاء العقد</h3>
            <ul>
                <li>ينتهي العقد بانتهاء مدته، ويلتزم المستأجر بتسليم العين المؤجرة لمالكها فور انتهاء مدة العقد.و لا
                    يتجدد العقد إلا بعقد جديد يتم الاتفاق عليه بين الطرفين.
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>البند التاسع: إخلاء العين المؤجرة</h3>
            <ul>
                <li>يجوز للمؤجر إخلاء المستأجر من العين المؤجرة، ويعتبر العقد مفسوخاً من تلقاء نفسه في أي من الحالات
                    التالية:
                </li>
                <br>
                <li> إذا امتنع المستأجر عن سداد مبلغ الأجرة المستحقة في ذمته في الموعد المحدد لها وفقاً لهذا العقد.
                </li>
                <br>
                <li> إذا تنازل المستأجر أو أجر من الباطن كل أو بعض العين المؤجرة أو أخلاها لغير مالكها دون إذن كتابي
                    مسبق من المؤجر.
                </li>
                <br>
                <li> إذا شغل المستأجر العين المؤجرة للسكنى بما يجاوز العدد المألوف.</li>
                <br>
                <li> إذا استعمل المستأجر العين المؤجرة بشكل يخالف النظام العام والآداب العامة أو بشكل يضر بمصلحة
                    المؤجر.
                </li>
                <br>
                <br>
                <br>
                <li> إذا أصبحت العين المؤجرة آيلة للسقوط ويخشى منها على سلامة السكان، أو صدر قرار إداري نهائي بالهدم
                    من البلدية المختصة.
                </li>
                <br>
                <br>
                <li> إذا استعمل المستأجر العين المؤجرة في غير الغرض المعدة من اجله أو أحدث تغييرا من شأنه الأضرار
                    بسلامتها الإنشائية.
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>البند العاشر: القانون الواجب التطبيق والاختصاص القضائي</h3>
            <ul>
                <li> يخضع هذا العقد ويفسر وفقاً لأحكام وقوانين مملكة البحرين، وتختص محاكم مملكة البحرين بنظر أي نزاع
                    ينشأ
                    عن هذا العقد.
                </li>
                <br>
                <br>
                <li> يتعين على الطرفين بذل كل جهد ممكن لتسوية أي نزاع أو خلاف ينشأ عن تفسير أي من أحكام هذا العقد
                    ودياً،
                    وفي حالة عدم توصل الطرفين لتسوية ودية، يحال النزاع للقضاء للبت فيه.
                </li>
                <br>
                <br>
                <br>
                <br>
                <br>
                <li>تحرر هذا العقد من نسختين سلم لكل طرف نسخة منها للعمل بموجبها</li>
                <li>في حالة وجود أي إختلاف أو تعارض بين النص العربي لهذا العقد والنص المترجم باللغة الإنجليزية يسري حكم
                    النص العربي وحده حيث أنه هو النص المعتمد.
                </li>
            </ul>
            <br>
            <h3>الطرف الأول</h3>
            <h3>الاسم:السيد/عبداللطيف أحمد الشيخ</h3>
            <ul>
                <li>التوقيع......................</li>
            </ul>

            <h3>الطرف الثاني</h3>
            <h3> الاسم:السيد/{{$data->User->name}}</h3>
            <ul>
                <li>التوقيع......................</li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
