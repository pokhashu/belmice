<?php
require '../../vendor/autoload.php';
require('../../vendor/setasign/fpdf/makefont/makefont.php');






//MakeFont('D:\\Downloads\\Bold Times New Roman.ttf','cp1251');

$pdf = new FPDF();
$pdf->AddFont('Times New Roman','','Times New Roman.php');
$pdf->AddFont('Bold Times New Roman','B','Bold Times New Roman.php');

function printHeader($text){
    global $pdf;
    $pdf->Ln(5);
    $pdf->SetFont('Bold Times New Roman','B',14);
    $pdf->MultiCell(0, 5,iconv('utf-8', 'windows-1251', strtoupper($text)), '0', 'C');
    $pdf->SetFont('Times New Roman','',14);
}
function printContractText($text){
    global $pdf;
    $text = str_replace("[TAB]","   ",$text);
    $pdf->SetFont('Times New Roman','',14);
    $pdf->MultiCell(0, 5,iconv('utf-8', 'windows-1251', $text), '0', 'J');
    $pdf->Ln(5);

}
//$orgName, $orgAddress, $orgFeePayerNum, $orgContactPhone, $orgContactEmail, $orgBank, $orgAccountNumber, $orgAgent
function createContract($contractNumber, $orgName, $orgAgentPosition, $orgAgent, $orgAgentAccordings, $dateOfArrival, $dateOfLeaving): array
{
    global $pdf;
    $name  = $orgName.', именуемое в дальнейшем «Заказчик», в лице '.$orgAgentPosition.' '.$orgAgent.', действующей на основании '.$orgAgentAccordings.', с одной стороны';

//    $pdf->AddFont('Century Gothic','','centurygothic.php');
//    $pdf->AddFont('Century Gothic','B','centurygothic_bold.php');
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->SetCreator("Туристическое агенство «Витаю в облаках»", true);
    $pdf->SetAuthor("Туристическое агенство «Витаю в облаках»", true);
    $pdf->SetLeftMargin(30);
    $pdf->SetRightMargin(10);
    $pdf->AddPage();
    $pdf->SetY(20);
    $pdf->SetFont('Times New Roman','',14);
    $pdf->MultiCell(0, 5,iconv('utf-8', 'windows-1251',
"УТВЕРЖДЕНО
Постановление Совета Министров
Республики Беларусь  12.11.2014 N 1064 
Приложение к постановлению
Совета Министров
Республики Беларусь
11.08.2022 № 523
\nТиповая форма\n\n\n\n
"), '0', 'R');
    $_y = $pdf->GetY();
    $_minsk = iconv('utf-8', 'windows-1251', "г. Минск");
    $pdf->Text(30, $_y, date('d.m.Y').iconv('utf-8', 'windows-1251', " г."));
    $pdf->Text(200-$pdf->GetStringWidth($_minsk), $_y, $_minsk);
    $pdf->SetFont('Bold Times New Roman','B',14);
    $pdf->MultiCell(0, 5,iconv('utf-8', 'windows-1251', "Договор"), '0', 'C');
    $pdf->MultiCell(0, 5,iconv('utf-8', 'windows-1251', "оказания туристических услуг № ".$contractNumber), '0', 'C');

    $pdf->SetFont('Times New Roman','',14);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 5,iconv('utf-8', 'windows-1251', $name.", и Общество с ограниченной ответственностью «Центр Поддержки Талантов», именуемое в дальнейшем «Исполнитель», в лице директора Ходько Андрея Андреевича, действующего на основании Устава, с другой стороны, а вместе именуемые «Стороны», заключили настоящий Договор о нижеследующем:"), '0', 'J');
    printHeader('1. ПРЕДМЕТ ДОГОВОРА');
    printContractText("1.1. В соответствии с условиями настоящего Договора Исполнитель по заявке Заказчика оказывает услуги по организации образовательно-творческого слета с ".$dateOfArrival." по ".$dateOfLeaving." по маршруту Минск-Линия Сталина-Дудутки, согласно Приложения 1, а Заказчик принимает и оплачивает их по согласованной сторонами стоимости.");
    printHeader('2. ОБЩИЕ УСЛОВИЯ');
    printContractText("2.1. В случае заключения настоящего договора в пользу третьих лиц Заказчик обязуется обеспечить исполнение этими третьими лицами условий настоящего договора и выражает тем самым их согласие на условия настоящего договора. 
Туристы (третьи лица, в пользу которых заключен настоящий договор) имеют право требовать от Исполнителя оказания им туристических услуг в соответствии с программой туристического путешествия согласно Приложению 1.
2.2. Количество туристов, которым оказываются туристические услуги в соответствии с настоящим договором, составляет 55 человека.
2.3. Минимальное количество человек, определенное туроператором при формировании тура, которое необходимо для осуществления туристического путешествия, согласованное Сторонами для оказания услуг по настоящему договору, составляет 55.
2.4. Качество туристических услуг должно соответствовать условиям настоящего договора, а также обязательным для соблюдения требованиям технических нормативных правовых актов в области технического нормирования и стандартизации, а при их отсутствии или неполноте – требованиям, обычно предъявляемым к услугам соответствующего типа.
");
    printHeader("3. СТОИМОСТЬ ТУРИСТИЧЕСКИХ УСЛУГ И ПОРЯДОК ИХ ОПЛАТЫ");
    printContractText("3.1. Стоимость услуг по настоящему договору составляет: 1 320 000 () российских рублей. Стоимость на одного человека 24 000 () российских рублей.
Согласованная стоимость по договору предварительная, окончательная стоимость услуг будет указана в Акте выполненных работ.
Валюта платежа – российские рубли.
3.2. Заказчик оплачивает услуги Исполнителя путем безналичного перечисления денежных средств на расчетный счет Исполнителя в сроки, указанные в счете Исполнителя, но не позднее, чем за один день до начала туристического путешествия.
3.3. В случае не осуществления платежа, Исполнитель имеет право не предоставлять туристическую услугу.
3.4. По завершении оказания услуг Исполнитель обязан передать Заказчику Акт сдачи-приемки оказанных услуг в течение 5 (пяти) рабочих дней. Заказчик обязуется в течение 5 (пяти) рабочих дней с даты получения подписать Акт сдачи-приемки оказанных услуг или предоставить Исполнителю мотивированный отказ от приемки услуг.
");
    printHeader("4. ПРАВА И ОБЯЗАННОСТИ СТОРОН");
    printContractText("4.1. Исполнитель имеет право на:
4.1.1. получение от Заказчика своевременно полной, достоверной информации, документов, а также сведений о себе и туристах в объеме, необходимом для исполнения обязательств по настоящему договору;
4.1.2. возмещение Заказчиком причиненных убытков (вреда) в случаях и порядке, установленных гражданским и гражданско-процессуальным законодательством. 
\n4.2. Исполнитель обязан:
4.2.1. предоставить своевременно Заказчику необходимую и достоверную информацию о программе туристического путешествия, включающую сведения:
о программе туристического путешествия;
о туроператоре, сформировавшем тур;
о стоимости туристических услуг, сроках и порядке их оплаты;
о комплексе мер, гарантирующих обеспечение личной безопасности и сохранности
имущества туристов, экскурсантов во время совершения туристического путешествия;
о точном времени начала туристического путешествия, не позднее чем за сутки
до даты начала туристического путешествия или в момент заключения настоящего
договора, если до начала туристического путешествия остается менее одних суток;
о принимающей стороне;
иную информацию, связанную с оказанием туристических услуг; а также информацию, предусмотренную законодательством о туризме, защите прав потребителей;
4.2.2. провести инструктаж Заказчика о соблюдении правил личной безопасности в порядке, установленном законодательством;
4.2.3. своевременно предоставить Заказчику документы, необходимые для совершения туристического путешествия;
4.2.4. предпринимать меры по соблюдению прав и законных интересов Заказчика и туристов;
4.2.5. обеспечить качество, в том числе безопасность, оказываемых в соответствии с настоящим договором туристических услуг;
4.2.6. возместить в случаях и порядке, установленных законодательством, убытки (вред), причиненные Заказчику и (или) туристам;
4.2.7. при одностороннем отказе от исполнения обязательств по настоящему договору во время совершения туристического путешествия по желанию туриста организовать его возвращение в место начала (окончания) туристического путешествия на условиях, не хуже предусмотренных настоящим договором;
4.2.8. в случае, если во время осуществления туристического путешествия окажется, что объем и качество оказываемых туристических услуг не соответствуют условиям настоящего договора и требованиям законодательства, заменить туристические услуги, оказываемые во время осуществления туристического путешествия, туристическими услугами аналогичного или более высокого качества без дополнительных расходов для Заказчика, а с согласия Заказчика либо туриста – туристическими услугами более низкого качества с возмещением Заказчику разницы между стоимостью туристических услуг, указанных в настоящем договоре, и стоимостью фактически оказанных туристических услуг;
4.2.9. информировать заказчика о непредвиденном росте стоимости отдельных услуг, входящих в комплекс туристических услуг;
4.2.10. уведомить заказчика о наступлении случаев невозможности исполнения своих обязательств по настоящему договору;
4.2.11. исполнять условия настоящего договора;
\n4.3. Заказчик имеет право:
4.3.1 требовать оказания туристам туристических услуг согласно настоящему договору и законодательству согласно приложению 1;
4.3.2. на возмещение исполнителем причиненного вреда в случаях и порядке, установленных гражданским и гражданско-процессуальным законодательством;
4.3.3. на обеспечение Исполнителем качества, в том числе безопасности, оказываемых туристических услуг; 
4.3.4. на обращение к исполнителю с претензией в случае невыполнения или ненадлежащего выполнения исполнителем условий настоящего договора;\n
\n4.4. Заказчик обязан:
4.4.1. ознакомиться сам, а также ознакомить туристов с условиями  настоящего договора, правилами личной безопасности и информацией. Самостоятельно ознакомиться и руководствоваться правилами выезда с территории Республики Беларусь и въезда на территорию Республики Беларусь;
4.4.2. своевременно представить исполнителю полную, достоверную информацию и документы, а также сведения о себе и туристах в объеме, необходимом для исполнения обязательств по настоящему договору;
4.4.3. исполнять условия настоящего договора;
4.4.4. обеспечить исполнение туристами следующих обязанностей:
4.4.4.1. своевременно прибывать к месту начала туристического путешествия, а также к местам сбора и отправки во время совершения туристического путешествия;
4.4.4.2. соблюдать законодательство страны (места) временного пребывания, уважать ее политическое и социальное устройство, обычаи, традиции, религии населения;
4.4.4.3. бережно относиться к окружающей среде, материальным историко-культурным ценностям;
4.4.4.4. соблюдать правила въезда и выезда из страны (места) временного пребывания (стран транзитного проезда);
4.4.4.5. соблюдать правила личной безопасности;
4.4.5. возместить фактически понесенные расходы Исполнителя в случае одностороннего отказа от исполнения настоящего договора;
");
    printHeader("5. ИЗМЕНЕНИЯ И ПРЕКРАЩЕНИЕ НАСТОЯЩЕГО ДОГОВОРА");
    printContractText("5.1.  Изменение и прекращение, в том числе расторжение, настоящего договора осуществляются по основаниям, предусмотренным настоящим договором и законодательством.
5.2. Изменение и расторжение настоящего договора по соглашению сторон совершаются в письменной форме путем заключения дополнительного соглашения к нему.
5.3. Настоящий договор может быть расторгнут в одностороннем порядке:
5.3.1. Исполнителем при условии полного возмещения Заказчику убытков на расчетный счет Заказчика в течение 3-х дней с момента расторжения договора.
5.3.2. Заказчиком при условии оплаты Исполнителю фактически понесенных им расходов.
5.4. В случае отсутствия минимального количества человек, определенного в пункте 2.2 настоящего договора, договор прекращает свое действие при условии возврата Исполнителем стоимости оплаченных туристических услуг и информирования Заказчика в  трёхдневный срок.
5.5. В случае расторжения Заказчиком настоящего договора в одностороннем порядке, Исполнитель обязан возвратить сумму внесенной предоплаты, с учетом фактически понесенных Исполнителем  расходов, на расчетный счет Заказчика в течение 3-х дней с момента расторжения договора.
");
    printHeader("6. ОТВЕТСТВЕННОСТЬ СТОРОН");
    printContractText("6.1. Стороны несут ответственность за неисполнение или ненадлежащее исполнение обязательств по настоящему договору в соответствии с законодательством Республики Беларусь.
6.2. Стороны не несут ответственность за неисполнение или ненадлежащее исполнение обязательств по настоящему договору в случае, если это оказалось невозможным вследствие возникновения обстоятельств непреодолимой силы, то есть чрезвычайных и непредотвратимых в данных условиях.
6.3. В случае возникновения обстоятельств непреодолимой силы и невозможности исполнения сторонами обязательств по настоящему договору каждая из сторон вправе требовать от другой стороны возврата всего, что она исполнила, не получив встречного удовлетворения.
6.4. Исполнитель не несет ответственность за возможный ущерб, нанесенный туристам по их собственной вине или по вине третьих лиц, предоставляющих во время осуществления туристического путешествия услуги, не входящие в его программу и вызванные инициативой самих туристов.
6.5. Стороны определили, что до обращения в суд с иском по спорам, вытекающим
из настоящего договора, заказчик обращается к исполнителю с соответствующей претензией в течение сроков, предусмотренных законодательством о защите прав потребителей. Стороны вправе использовать иной не противоречащий законодательству досудебный порядок регулирования споров, вытекающих из настоящего договора, с соблюдением сроков удовлетворения требований потребителей, установленных законодательством о защите прав потребителей.
");
    printHeader("7. ЗАКЛЮЧИТЕЛЬНЫЕ ПОЛОЖЕНИЯ");
    printContractText("7.1. Настоящий договор вступает в силу с момента его заключения сторонами и действует до полного исполнения обязательств по нему.
7.2. Настоящий договор составлен на русском языке в 2 экземплярах, имеющих одинаковую юридическую силу. Стороны договорились о том, что все документы, согласованные и подписанные сторонами и переданные по каналам факсимильной или электронной средств связи, имеют юридическую силу до предоставления оригиналов указанных документов в бумажном виде.
7.3. Все споры по настоящему договору разрешаются в порядке, предусмотренном законодательством Республики Беларусь.
");
    printHeader("8. РЕКВИЗИТЫ И ПОДПИСИ СТОРОН");
    $pdf->Ln(3);
    $pdf->SetFont('Bold Times New Roman','B',14);
    $_y = $pdf->GetY();
    $_x = $pdf->GetX()+80+10;
    $pdf->MultiCell(80, 5, iconv('utf-8', 'windows-1251', "ИСПОЛНИТЕЛЬ"), 0, "L");
    $pdf->SetY($_y);
    $pdf->SetX($_x);
    $pdf->MultiCell(80, 5, iconv('utf-8', 'windows-1251', "ЗАКАЗЧИК"), 0, "L");
    $pdf->SetFont('Times New Roman','',14);
    $pdf->Ln(1);
    $orgrec1 = "ООО «Гоу Бел Тур»
220005, г. Минск, 
ул. Красная, д. 13, офис 518
ОКПО 382514205000 УНН 192537290
Тел.: +375 17 284 92 08, +375 17 399 16 83
info@gobel.by www.minskmice.com
ЗАО «Альфа-Банк», г. Минск, ул. Сурганова, 43-47 
BIC ALFABY2X
р/с BY41ALFA30122785780010270000 (BYN) 
";
    $orgrec2 = "ООО «Гоу Бел Тур»
220005, г. Минск, 
ул. Красная, д. 13, офис 518
ОКПО 382514205000 УНН 192537290
Тел.: +375 17 284 92 08, +375 17 399 16 83
info@gobel.by www.minskmice.com
ЗАО «Альфа-Банк», г. Минск, ул. Сурганова, 43-47 
BIC ALFABY2X
р/с BY41ALFA30122785780010270000 (BYN) 
";
    $_y = $pdf->GetY();
    $_x = $pdf->GetX()+80+10;
    $pdf->MultiCell(80, 5, iconv('utf-8', 'windows-1251', $orgrec1), 0, "L");
    $pdf->SetY($_y);
    $pdf->SetX($_x);
    $pdf->MultiCell(80, 5, iconv('utf-8', 'windows-1251', $orgrec2), 0, "L");










    $name = 'TEST_Doc_'.strftime('%H%M%S', time()).'.pdf';
//    $name = 'TEST_Doc_'.date('Y-m-d').'_'.uniqid().'.pdf';
    $pdf->Output($name, "F");
    return ["res"=>'done', "href"=>$name];
}
createContract(date('my').'-1', "Общество с ограниченной ответственностью 'Рога и Копыта'", "Директора", "Сергановской Виктории Сергеевны", "Устава");
