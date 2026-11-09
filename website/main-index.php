<?php if (!defined('FLUX_ROOT')) exit; ?>

<div class="ro-home">
  <section class="ro-hero ro-angel-hero">
    <div class="ro-hero-copy">
      <div class="ro-kicker">A little magic. A legendary adventure.</div>
      <h1>Welcome to Rune Midgard.</h1>
      <p>Adventure awaits beneath the light of Angeling. Meet friends, explore mysterious lands, challenge mighty monsters, and write your own Ragnarok legend.</p>
      <div class="ro-actions">
        <a class="ro-button secondary" href="?module=server&amp;action=info">Explore Server Info</a>
      </div>
    </div>
    <div class="ro-angelring-stage" role="img" aria-label="A cheerful pink Angeling Poring with a golden halo and angel wings">
      <div class="ro-angelring-aura"></div>
      <svg class="ro-angelring" viewBox="0 0 520 430" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <defs>
          <radialGradient id="angelBody" cx="38%" cy="28%" r="72%">
            <stop offset="0" stop-color="#fff4fb"/>
            <stop offset=".28" stop-color="#ffb8df"/>
            <stop offset=".72" stop-color="#f47fbd"/>
            <stop offset="1" stop-color="#c94f9a"/>
          </radialGradient>
          <linearGradient id="angelWing" x1="0" y1="0" x2="1" y2="1">
            <stop stop-color="#fff" />
            <stop offset="1" stop-color="#bfeaff" />
          </linearGradient>
          <linearGradient id="angelHalo" x1="0" y1="0" x2="1" y2="1">
            <stop stop-color="#fff5b8"/>
            <stop offset=".5" stop-color="#f7c85c"/>
            <stop offset="1" stop-color="#c88725"/>
          </linearGradient>
          <filter id="angelGlow" x="-80%" y="-80%" width="260%" height="260%">
            <feGaussianBlur stdDeviation="12" result="blur"/>
            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
          </filter>
          <filter id="angelShadow" x="-50%" y="-50%" width="200%" height="200%">
            <feGaussianBlur stdDeviation="12"/>
          </filter>
        </defs>
        <ellipse cx="260" cy="374" rx="142" ry="20" fill="#000" opacity=".22" filter="url(#angelShadow)"/>
        <g class="angel-sparkles" fill="#ffe7a3">
          <path d="M83 145l7 19 19 7-19 7-7 19-7-19-19-7 19-7z"/>
          <path d="M431 112l5 14 14 5-14 5-5 14-5-14-14-5 14-5z"/>
          <path d="M410 280l4 11 11 4-11 4-4 11-4-11-11-4 11-4z"/>
          <circle cx="127" cy="260" r="4"/><circle cx="384" cy="185" r="5"/>
          <circle cx="169" cy="89" r="3"/><circle cx="350" cy="70" r="3"/>
        </g>
        <g class="angel-halo" filter="url(#angelGlow)">
          <ellipse cx="260" cy="64" rx="76" ry="20" fill="none" stroke="url(#angelHalo)" stroke-width="10"/>
          <ellipse cx="260" cy="64" rx="76" ry="20" fill="none" stroke="#fff5c9" stroke-width="2" opacity=".9"/>
        </g>
        <g class="angel-wings">
          <path d="M169 214C112 164 64 183 68 232c3 34 40 57 93 48-38 13-49 39-29 55 29 23 83-7 109-57z" fill="url(#angelWing)" stroke="#d5efff" stroke-width="5"/>
          <path d="M351 214c57-50 105-31 101 18-3 34-40 57-93 48 38 13 49 39 29 55-29 23-83-7-109-57z" fill="url(#angelWing)" stroke="#d5efff" stroke-width="5"/>
          <path d="M91 224q28-18 57 16M93 252q28-12 53 8M429 224q-28-18-57 16M427 252q-28-12-53 8" fill="none" stroke="#a9d9f5" stroke-width="5" stroke-linecap="round"/>
        </g>
        <path d="M145 276c0-72 50-126 115-126s115 54 115 126c0 61-49 99-115 99s-115-38-115-99z" fill="url(#angelBody)" stroke="#e978b6" stroke-width="5"/>
        <ellipse cx="216" cy="226" rx="29" ry="18" fill="#fff" opacity=".45" transform="rotate(-28 216 226)"/>
        <ellipse cx="190" cy="291" rx="18" ry="10" fill="#ff83bd" opacity=".55"/>
        <ellipse cx="330" cy="291" rx="18" ry="10" fill="#ff83bd" opacity=".55"/>
        <g fill="#4a3151">
          <ellipse cx="222" cy="270" rx="7" ry="12"/>
          <ellipse cx="298" cy="270" rx="7" ry="12"/>
        </g>
        <g fill="#fff">
          <circle cx="224" cy="266" r="3"/><circle cx="300" cy="266" r="3"/>
        </g>
        <path d="M246 292q14 14 28 0" fill="none" stroke="#9f416f" stroke-width="5" stroke-linecap="round"/>
        <path d="M260 145q-8-15 2-26 12 13 3 26" fill="#ffb4dc"/>
        <path d="M248 365q12 8 24 0" fill="none" stroke="#d75b9d" stroke-width="5" stroke-linecap="round"/>
      </svg>
      <div class="ro-angelring-caption">ANGELING <span>✦</span> Guardian of good vibes</div>
    </div>
    <div class="ro-hero-bottom-glow"></div>
  </section>

  <h2 class="ro-section-title">Welcome to <?php echo htmlspecialchars(Flux::config('SiteTitle')) ?></h2>
  <div class="ro-grid">
    <div class="ro-card"><span class="ro-icon" aria-hidden="true">⚔</span><strong>Adventure &amp; Progress</strong><span>Build your character and prepare for the journey ahead.</span></div>
    <div class="ro-card"><span class="ro-icon" aria-hidden="true">🏰</span><strong>Guilds &amp; Community</strong><span>Find your party, make friends, and stand together.</span></div>
    <div class="ro-card"><span class="ro-icon" aria-hidden="true">🏆</span><strong>Rankings &amp; Competition</strong><span>Track the legends of Rune Midgard as game services come online.</span></div>
  </div>

  <div class="ro-note">The control-panel website is online. Game-server connectivity, live status, rankings, and game data will be enabled after the rAthena server is installed and connected.</div>

  <h2 class="ro-section-title">Latest News &amp; Announcements</h2>
  <?php if (Flux::config('CMSNewsOnHomepage')): ?>
    <?php if (isset($newstype) && $newstype == '1' && !empty($news)): ?>
      <?php foreach ($news as $nrow): ?>
        <article class="ro-news">
          <h3><?php echo htmlspecialchars($nrow->title) ?></h3>
          <small>Posted by <?php echo htmlspecialchars($nrow->author) ?> · <?php echo date(Flux::config('DateFormat'), strtotime($nrow->created)) ?></small>
          <div><?php echo $nrow->body ?></div>
          <?php if (!empty($nrow->link)): ?><a href="<?php echo htmlspecialchars($nrow->link) ?>">Read more</a><?php endif; ?>
        </article>
      <?php endforeach; ?>
    <?php elseif (isset($newstype) && $newstype == '2' && isset($xml) && isset($xml->channel)): ?>
      <?php $roNewsCount = 0; ?>
      <?php foreach ($xml->channel->item as $rssItem): ?>
        <?php if (++$roNewsCount > (int)$newslimit) break; ?>
        <article class="ro-news">
          <h3><?php echo htmlspecialchars((string)$rssItem->title) ?></h3>
          <small><?php echo !empty($rssItem->pubDate) ? date(Flux::config('DateFormat'), strtotime((string)$rssItem->pubDate)) : '' ?></small>
          <p><?php echo htmlspecialchars((string)$rssItem->description) ?></p>
          <a href="<?php echo htmlspecialchars((string)$rssItem->link) ?>" target="_blank" rel="noopener noreferrer">Read more</a>
        </article>
      <?php endforeach; ?>
      <?php if ($roNewsCount === 0): ?><p class="ro-note">No announcements have been posted yet. Please check back soon.</p><?php endif; ?>
    <?php else: ?>
      <p class="ro-note">No announcements have been posted yet. Please check back soon.</p>
    <?php endif; ?>
  <?php else: ?>
    <p class="ro-note">Announcements will appear here. Check back for news and updates.</p>
  <?php endif; ?>
</div>
