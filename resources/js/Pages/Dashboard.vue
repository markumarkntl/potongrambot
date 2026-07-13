<script setup>
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineOptions({ layout: AppLayout });

const props = defineProps({
  trending: {
    type: Array,
    default: () => [],
  },
});

const getTitle = (anime) => anime.title.english || anime.title.romaji || anime.title.native;

const scoreColor = (score) => {
  if (!score) return 'secondary';
  if (score >= 75) return 'success';
  if (score >= 50) return 'warning';
  return 'error';
};

const openAnime = (anime) => {
  router.get(route('anime.show', anime.id));
};
</script>

<template>
  <VRow>
    <VCol cols="12" class="d-flex align-center mb-2">
      <VIcon
        icon="mdi-fire"
        color="error"
        size="28"
        class="me-2"
      />
      <h4 class="text-h4">
        Trending Anime
      </h4>
    </VCol>

    <VCol
      v-for="anime in props.trending"
      :key="anime.id"
      cols="6"
      sm="4"
      md="3"
      lg="2"
    >
      <VCard
        class="anime-card h-100"
        rounded="lg"
        elevation="2"
        @click="openAnime(anime)"
      >
        <div class="position-relative">
          <VImg
            :src="anime.coverImage.large"
            height="260"
            cover
            class="anime-cover"
          >
            <template #placeholder>
              <div class="d-flex align-center justify-center fill-height">
                <VProgressCircular indeterminate color="primary" />
              </div>
            </template>
          </VImg>

          <VChip
            v-if="anime.averageScore"
            size="small"
            :color="scoreColor(anime.averageScore)"
            class="score-badge"
            variant="elevated"
          >
            <VIcon
              icon="mdi-star"
              size="14"
              start
            />
            {{ anime.averageScore }}%
          </VChip>

          <VChip
            size="x-small"
            color="rgba(0,0,0,0.6)"
            class="format-badge"
            variant="flat"
          >
            {{ anime.episodes ? anime.episodes + ' Eps' : anime.format }}
          </VChip>
        </div>

        <VCardItem class="pb-2">
          <VCardTitle
            class="text-body-2 font-weight-medium anime-title"
          >
            {{ getTitle(anime) }}
          </VCardTitle>
        </VCardItem>

        <VCardText class="pt-0 d-flex flex-wrap gap-1">
          <VChip
            v-for="genre in (anime.genres || []).slice(0, 2)"
            :key="genre"
            size="x-small"
            variant="tonal"
            color="primary"
          >
            {{ genre }}
          </VChip>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>

<style scoped>
.anime-card {
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.anime-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16) !important;
}

.score-badge {
  position: absolute;
  top: 8px;
  right: 8px;
}

.format-badge {
  position: absolute;
  top: 8px;
  left: 8px;
  color: #fff;
}

.anime-title {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  white-space: normal;
  line-height: 1.3;
  min-height: 2.6em;
}
</style>