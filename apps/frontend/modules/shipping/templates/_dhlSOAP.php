POST /app/ecas/eCASOrderWS.asmx HTTP/1.1
Host: http://webapps.dhl.com.pl
Content-Type: text/xml; charset=utf-8
Content-Length: length
SOAPAction: "eCASOrderWS/DodajZlecenieWS"

<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <DodajZlecenieWS xmlns="eCASOrderWS">
      <zlecenie>
        <Firma>string</Firma>
        <Ulica>string</Ulica>
        <Numer>string</Numer>
        <KodPocztowy>string</KodPocztowy>
        <Miasto>string</Miasto>
        <NumerSAP>string</NumerSAP>
        <Platnik>string</Platnik>
        <FormaPlatnosci>string</FormaPlatnosci>
        <DataPrzyjazduKuriera>string</DataPrzyjazduKuriera>
        <PrzesylkaGotowaOd>string</PrzesylkaGotowaOd>
        <ObiorMozliwyDo>string</ObiorMozliwyDo>
        <IloscPrzesylekDo31>int</IloscPrzesylekDo31>
        <IloscPrzesylekPow31>int</IloscPrzesylekPow31>
        <WagaNajciezszej>string</WagaNajciezszej>
        <ImieNazwisko>string</ImieNazwisko>
        <Email>string</Email>
        <TelefonStacjonarny>string</TelefonStacjonarny>
        <TelefonKomorkowy>string</TelefonKomorkowy>
        <DodatkoweInstrukcje>string</DodatkoweInstrukcje>
        <MiejsceNadania>string</MiejsceNadania>
      </zlecenie>
    </DodajZlecenieWS>
  </soap:Body>
</soap:Envelope>
