<?php
// Blackjack preview page. This is intentionally a play-credit demo only.
// Real Zeny wagering must be implemented server-side after rAthena auth is connected.
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Midgard Blackjack — Rune Midgard</title>
<link rel="stylesheet" href="/themes/custom_theme/css/ro-custom.css">
<style>
.bj-page{max-width:1160px;margin:28px auto 100px;padding:0 18px;color:#edf2fb}
.bj-top{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px}
.bj-eyebrow{color:#e8bd67;font-size:11px;font-weight:800;letter-spacing:.2em;text-transform:uppercase}
.bj-title{margin:4px 0;color:#fff0c9;font:700 clamp(28px,5vw,44px)/1.1 Georgia,serif}
.bj-subtitle{color:#a9b7cd;margin:8px 0 0}
.bj-demo{padding:9px 13px;border:1px solid #9d7535;border-radius:999px;background:#382b19;color:#ffdf9b;font-size:11px;font-weight:800;letter-spacing:.1em}
.bj-layout{display:grid;grid-template-columns:minmax(0,1fr) 270px;gap:16px}
.bj-table{position:relative;overflow:hidden;min-height:540px;padding:26px clamp(14px,3vw,32px);border:1px solid rgba(232,189,103,.55);border-radius:22px;background:radial-gradient(ellipse at center,#17644f 0%,#104936 48%,#092b25 100%);box-shadow:inset 0 0 0 8px rgba(6,24,23,.45),0 20px 55px #0007}
.bj-table:before{content:"";position:absolute;inset:18px;border:1px solid rgba(238,207,133,.25);border-radius:50% / 38%;pointer-events:none}
.bj-table-inner{position:relative;z-index:1;display:flex;flex-direction:column;min-height:480px;justify-content:space-between}
.bj-hand-area{text-align:center;min-height:155px}
.bj-hand-label{color:#f2d99d;font-size:11px;font-weight:800;letter-spacing:.18em;text-transform:uppercase}
.bj-cards{display:flex;justify-content:center;align-items:center;gap:9px;min-height:112px;margin-top:10px;flex-wrap:wrap}
.bj-card{width:68px;height:98px;display:flex;flex-direction:column;justify-content:space-between;padding:7px 8px;border-radius:8px;background:linear-gradient(145deg,#fff,#e8e6df);color:#172033;box-shadow:0 7px 14px #0005;border:1px solid #d6d2c7;font-family:Georgia,serif;text-align:left;animation:bj-deal .22s ease-out}
.bj-card.red{color:#bd3544}.bj-card .rank{font-size:21px;font-weight:bold;line-height:1}.bj-card .suit{font-size:19px;line-height:1}.bj-card .center{align-self:center;font-size:28px}
.bj-card.back{background:repeating-linear-gradient(45deg,#182b4a 0 5px,#263e63 5px 10px);border:3px solid #e8bd67;color:#f5d995;align-items:center;justify-content:center;font-size:30px}
.bj-hand-total{margin-top:7px;color:#fff0c9;font-weight:800;font-size:13px}
.bj-divider{height:1px;margin:12px auto 16px;max-width:500px;background:linear-gradient(90deg,transparent,#e8bd67aa,transparent)}
.bj-player-area{display:flex;flex-direction:column;justify-content:flex-end;min-height:185px;text-align:center}
.bj-player-hands{display:flex;justify-content:center;align-items:flex-start;gap:24px;flex-wrap:wrap}
.bj-player-hand{padding:8px 10px;border-radius:12px;border:1px solid transparent;min-width:160px}
.bj-player-hand.active{border-color:#f4d58b;background:#fff1c20d;box-shadow:0 0 22px #e8bd6722}
.bj-player-hand .bj-cards{min-height:105px}
.bj-status{min-height:25px;margin:10px 0 0;color:#ffe4a4;font-weight:700}
.bj-side{display:flex;flex-direction:column;gap:13px}
.bj-panel{padding:17px;border:1px solid #304362;border-radius:14px;background:linear-gradient(145deg,#192945,#101a2d);box-shadow:0 9px 25px #0003}
.bj-panel h2{margin:0 0 12px;color:#f4d99e;font:700 16px Georgia,serif}
.bj-balance{font-size:27px;font-weight:900;color:#ffe0a0;font-variant-numeric:tabular-nums}
.bj-muted{color:#9eafc6;font-size:12px}
.bj-bet-value{font-size:23px;font-weight:800;color:#fff0c9}
.bj-chips{display:grid;grid-template-columns:repeat(2,1fr);gap:7px;margin-top:11px}
.bj-chip,.bj-action{border:1px solid #8e6b36;border-radius:8px;padding:9px 8px;color:#f9dfaa;background:linear-gradient(180deg,#34435a,#1b2a40);font-weight:800;cursor:pointer}
.bj-chip:hover,.bj-action:hover{filter:brightness(1.18);transform:translateY(-1px)}
.bj-chip:disabled,.bj-action:disabled{opacity:.35;cursor:not-allowed;transform:none}
.bj-actions{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;margin-top:12px}
.bj-action.primary{grid-column:1/-1;background:linear-gradient(180deg,#f5d995,#d7a84e);color:#172033;border-color:#f4d28c}
.bj-action.subtle{background:#152238;border-color:#40516c}
.bj-rules{padding-left:17px;margin:0;color:#b9c8dc;font-size:12px}.bj-rules li{margin:6px 0}
.bj-history{max-height:155px;overflow:auto;color:#b9c8dc;font-size:12px}.bj-history p{margin:7px 0;padding-bottom:7px;border-bottom:1px solid #ffffff12}
.bj-footnote{margin:15px 2px 0;color:#8394ac;font-size:11px;line-height:1.6}
@keyframes bj-deal{from{opacity:0;transform:translateY(-12px) rotate(-3deg)}to{opacity:1;transform:translateY(0) rotate(0)}}
@media(max-width:850px){.bj-layout{grid-template-columns:1fr}.bj-side{display:grid;grid-template-columns:repeat(2,minmax(0,1fr))}.bj-panel:last-child{grid-column:1/-1}.bj-table{min-height:500px}}
@media(max-width:560px){.bj-page{padding:0 10px}.bj-side{grid-template-columns:1fr}.bj-panel:last-child{grid-column:auto}.bj-table{padding:20px 8px;min-height:490px}.bj-card{width:55px;height:82px;padding:6px}.bj-card .rank{font-size:17px}.bj-card .suit{font-size:16px}.bj-card .center{font-size:22px}.bj-cards{gap:5px}.bj-player-hands{gap:5px}.bj-player-hand{min-width:135px;padding:5px 2px}}
</style>
</head>
<body class="ro-site">
<main class="bj-page">
  <div class="bj-top">
    <div><div class="bj-eyebrow">Rune Midgard · Casino</div><h1 class="bj-title">Midgard Blackjack</h1><p class="bj-subtitle">Test your luck at the royal table.</p></div>
    <div class="bj-demo">DEMO TABLE · PLAY CREDITS ONLY</div>
  </div>
  <div class="bj-layout">
    <section class="bj-table" aria-label="Blackjack table">
      <div class="bj-table-inner">
        <div class="bj-hand-area">
          <div class="bj-hand-label">Dealer</div>
          <div class="bj-cards" id="dealer-cards"><div class="bj-card back">✦</div><div class="bj-card back">✦</div></div>
          <div class="bj-hand-total" id="dealer-total">—</div>
        </div>
        <div class="bj-divider"></div>
        <div class="bj-player-area">
          <div class="bj-hand-label">Your hand</div>
          <div class="bj-player-hands" id="player-hands"><div class="bj-muted">Place your demo bet and deal to begin.</div></div>
          <div class="bj-status" id="game-status" aria-live="polite">Welcome to Midgard Blackjack.</div>
        </div>
      </div>
    </section>
    <aside class="bj-side">
      <section class="bj-panel">
        <h2>Demo wallet</h2><div class="bj-balance" id="balance">10,000</div><div class="bj-muted">Play credits · not Ragnarok Zeny</div>
      </section>
      <section class="bj-panel">
        <h2>Your wager</h2><div class="bj-bet-value" id="bet-value">100 credits</div><div class="bj-chips">
          <button class="bj-chip" data-bet="100">100</button><button class="bj-chip" data-bet="500">500</button><button class="bj-chip" data-bet="1000">1,000</button><button class="bj-chip" data-bet="5000">5,000</button>
        </div>
        <div class="bj-actions">
          <button class="bj-action primary" id="deal">Deal cards</button>
          <button class="bj-action" id="hit" disabled>Hit</button><button class="bj-action" id="stand" disabled>Stand</button>
          <button class="bj-action" id="double" disabled>Double</button><button class="bj-action" id="split" disabled>Split</button>
          <button class="bj-action subtle" id="new-round" disabled>New round</button>
        </div>
      </section>
      <section class="bj-panel">
        <h2>Table rules</h2>
        <ul class="bj-rules"><li>Blackjack pays 3:2.</li><li>Dealer stands on soft 17.</li><li>Double on your first two cards.</li><li>One split per round in this preview.</li><li>Dealer draws to 17.</li></ul>
      </section>
      <section class="bj-panel">
        <h2>Recent rounds</h2><div class="bj-history" id="history"><p>No rounds played yet.</p></div>
      </section>
    </aside>
  </div>
  <p class="bj-footnote">Preview only: this page uses temporary browser-side demo credits. It does not connect to a player account, deduct Ragnarok Zeny, or award real Zeny. Real-money-value wagering is not enabled. The production version will require authenticated character selection and secure server-side balance transactions after rAthena is connected.</p>
</main>
<script>
(function(){
'use strict';
var balance=10000,bet=100,deck=[],dealer=[],hands=[],active=0,phase='betting',splitUsed=false,roundNo=0;
var $=function(id){return document.getElementById(id)};
var suits=['♠','♥','♦','♣'],ranks=['A','2','3','4','5','6','7','8','9','10','J','Q','K'];
function randomIndex(max){var a=new Uint32Array(1);crypto.getRandomValues(a);return a[0]%max}
function makeDeck(){deck=[];for(var i=0;i<ranks.length;i++)for(var j=0;j<suits.length;j++)deck.push({rank:ranks[i],suit:suits[j]});for(var k=deck.length-1;k>0;k--){var n=randomIndex(k+1),t=deck[k];deck[k]=deck[n];deck[n]=t}}
function draw(){if(!deck.length)makeDeck();return deck.pop()}
function value(cards){var total=0,aces=0;cards.forEach(function(c){if(c.rank==='A'){total+=11;aces++}else total+=['K','Q','J'].indexOf(c.rank)>=0?10:parseInt(c.rank,10)});while(total>21&&aces){total-=10;aces--}return total}
function soft17(cards){var total=0,aces=0;cards.forEach(function(c){if(c.rank==='A'){total+=11;aces++}else total+=['K','Q','J'].indexOf(c.rank)>=0?10:parseInt(c.rank,10)});return total===17&&aces>0}
function natural(cards){return cards.length===2&&value(cards)===21}
function cardHtml(c,hidden){if(hidden)return '<div class="bj-card back" aria-label="Hidden card">✦</div>';var red=c.suit==='♥'||c.suit==='♦';return '<div class="bj-card '+(red?'red':'')+'"><span class="rank">'+c.rank+'</span><span class="center">'+c.suit+'</span><span class="suit" style="align-self:flex-end">'+c.suit+'</span></div>'}
function render(){ $('balance').textContent=balance.toLocaleString();$('bet-value').textContent=bet.toLocaleString()+' credits';
$('dealer-cards').innerHTML=dealer.length?dealer.map(function(c,i){return cardHtml(c,phase==='playing'&&i===1)}).join(''):'<div class="bj-muted">Dealer cards appear here</div>';
$('dealer-total').textContent=phase==='playing'?'':dealer.length?'Total: '+value(dealer):'—';
$('player-hands').innerHTML=hands.length?hands.map(function(h,i){return '<div class="bj-player-hand '+(i===active&&phase==='playing'?'active':'')+'"><div class="bj-muted">Hand '+(i+1)+(h.result?' · '+h.result:'')+'</div><div class="bj-cards">'+h.cards.map(function(c){return cardHtml(c,false)}).join('')+'</div><div class="bj-hand-total">Total: '+value(h.cards)+'</div></div>'}).join(''):'<div class="bj-muted">Place your demo bet and deal to begin.</div>';
document.querySelectorAll('[data-bet]').forEach(function(b){b.disabled=phase!=='betting'||balance<Number(b.getAttribute('data-bet'));b.style.outline=Number(b.getAttribute('data-bet'))===bet?'2px solid #f4d58b':''});
$('deal').disabled=phase!=='betting'||balance<bet;$('hit').disabled=phase!=='playing';$('stand').disabled=phase!=='playing';
$('double').disabled=phase!=='playing'||hands.length===0||hands[active].cards.length!==2||balance<hands[active].bet;
$('split').disabled=phase!=='playing'||splitUsed||hands.length!==1||hands[0].cards.length!==2||hands[0].cards[0].rank!==hands[0].cards[1].rank||balance<hands[0].bet;
$('new-round').disabled=phase!=='settled';
}
function status(s){$('game-status').textContent=s}
function begin(){if(phase!=='betting'||balance<bet)return;balance-=bet;makeDeck();dealer=[draw(),draw()];hands=[{cards:[draw(),draw()],bet:bet,result:'',done:false,natural:true}];active=0;splitUsed=false;phase='playing';status('Your move. Hit, stand, double, or split.');if(natural(hands[0].cards)){hands[0].done=true;finishRound()}render()}
function nextHand(){for(var i=active+1;i<hands.length;i++)if(!hands[i].done){active=i;status('Hand '+(i+1)+': your move.');render();return}finishRound()}
function hit(){if(phase!=='playing')return;var h=hands[active];h.cards.push(draw());h.natural=false;if(value(h.cards)>21){h.done=true;h.result='Bust';nextHand()}else render()}
function stand(){if(phase!=='playing')return;hands[active].done=true;hands[active].result='Stand';nextHand()}
function doubleDown(){if(phase!=='playing')return;var h=hands[active];if(h.cards.length!==2||balance<h.bet)return;balance-=h.bet;h.bet*=2;h.cards.push(draw());h.natural=false;h.done=true;h.result=value(h.cards)>21?'Bust':'Doubled';nextHand()}
function split(){if(phase!=='playing'||splitUsed||hands.length!==1)return;var h=hands[0];if(h.cards.length!==2||h.cards[0].rank!==h.cards[1].rank||balance<h.bet)return;balance-=h.bet;var c=h.cards;hands=[{cards:[c[0],draw()],bet:h.bet,result:'',done:false,natural:false},{cards:[c[1],draw()],bet:h.bet,result:'',done:false,natural:false}];splitUsed=true;active=0;if(hands[0].cards[0].rank==='A'){hands.forEach(function(x){x.done=true;x.result='Split aces'});finishRound()}else status('Split! Play hand 1.');render()}
function finishRound(){phase='settling';var canDealer=hands.some(function(h){return value(h.cards)<=21});if(canDealer){while(value(dealer)<17||soft17(dealer))dealer.push(draw())}
var dv=value(dealer),dBust=dv>21,dNat=natural(dealer),net=0;
hands.forEach(function(h){var pv=value(h.cards),pNat=h.natural&&natural(h.cards),win=0,label='';
if(pv>21){label='Lost';}
else if(pNat&&dNat){balance+=h.bet;win=h.bet;label='Push';}
else if(pNat){var payout=h.bet*2.5;balance+=payout;win=payout-h.bet;label='Blackjack +'+(h.bet*1.5).toLocaleString();}
else if(dNat){label='Dealer blackjack';}
else if(dBust||pv>dv){var payout=h.bet*2;balance+=payout;win=h.bet;label='Won +'+h.bet.toLocaleString();}
else if(pv===dv){balance+=h.bet;win=0;label='Push';}
else{label='Lost';}
h.result=label;net+=win;
});
phase='settled';roundNo++;var summary='Round '+roundNo+': '+hands.map(function(h,i){return 'Hand '+(i+1)+' '+h.result}).join(' · ');var p=document.createElement('p');p.textContent=summary;$('history').prepend(p);while($('history').children.length>8)$('history').lastChild.remove();status(summary+' — Dealer total: '+dv+'.');render()}
document.querySelectorAll('[data-bet]').forEach(function(b){b.addEventListener('click',function(){if(phase==='betting'){bet=Number(b.getAttribute('data-bet'));render()}})});
$('deal').addEventListener('click',begin);$('hit').addEventListener('click',hit);$('stand').addEventListener('click',stand);$('double').addEventListener('click',doubleDown);$('split').addEventListener('click',split);
$('new-round').addEventListener('click',function(){if(phase!=='settled')return;dealer=[];hands=[];phase='betting';active=0;status('Place your next demo bet.');render()});
render();
})();
</script>
</body>
</html>
